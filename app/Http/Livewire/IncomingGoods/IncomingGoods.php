<?php

namespace App\Http\Livewire\IncomingGoods;

use App\Models\Goods;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class IncomingGoods extends Component
{
	use WithPagination;
	protected $listeners = [
		'deleteConfirmed' => 'delete',
		'deleteCheckedData',
	];
	public $id_item, $date, $qty, $purchase_price; // data
	public $searchTerm, $lengthData; // search dan sorting
	public $updateMode = false;
	public $idRemoved = NULL; // mendifinisikan id untuk hapus data
	public $paginationTheme = 'bootstrap'; // mendifinisikan pagination bertema bootstrap
	public $checkedId = []; // menghapus data banyak yang ditampung ke array
	
	/**
	 * @description function mount() untuk mengisi value pada inputan
	 * @see https://laravel-livewire.com/docs/2.x/rendering-components
	 */
	public function mount()
	{
		$this->id_item = Goods::where('types_of_goods', 'Cleaning Supply')->min('id'); // mengambil id barang pertama
		$this->date = date('Y-m-d');
		$this->qty = 0;
		$this->purchase_price = 0;
	}

	/**
	 * @description function resetInputFields() untuk mereset value inputan, dan menggantikan value baru
	 * @see https://laravel-livewire.com/docs/2.x/properties
	 */
	public function resetInputFields()
	{
		$this->id_item = Goods::where('types_of_goods', 'Cleaning Supply')->min('id'); // mengambil id barang pertama
		$this->date = date('Y-m-d');
		$this->qty = 0;
		$this->purchase_price = 0;
	}
	public function cancel()
	{
		$this->updateMode = false;
		$this->resetInputFields();
	}

	/**
	 * @description function render() untuk merender data dari database ke view
	 * @see https://laravel-livewire.com/docs/2.x/rendering-components
	 */
    public function render()
    {
		$searchTerm = '%'.$this->searchTerm.'%';
		$lengthData = $this->lengthData;

		$items = Goods::select('id', 'name_of_goods', 'item_code')->where('types_of_goods', 'Cleaning Supply')->get();

		$data = Goods::from('goods as a')
					->select('b.id', 'a.name_of_goods', 'a.item_unit', 'b.date', 'b.qty', 'b.purchase_price')
					->join('inventories as b', 'b.id_item', 'a.id')
					->where('b.category', 'In')
					->where(function($query) use ($searchTerm){
						$query->where('a.name_of_goods', 'LIKE', $searchTerm);
						$query->orWhere('a.item_unit', 'LIKE', $searchTerm);
						$query->orWhere('b.date', 'LIKE', $searchTerm);
						$query->orWhere('b.qty', 'LIKE', $searchTerm);
						$query->orWhere('b.purchase_price', 'LIKE', $searchTerm);
					})
					->orderBy('b.date', 'DESC')
					->orderBy('b.id', 'DESC')
					->paginate($lengthData);

        return view('livewire.incoming-goods.incoming-goods', compact('data', 'items'))
			->extends('layouts.apps', ['title' => 'Incoming Goods']);
    }

	/**
	 * @description function store() untuk store data dari inputan ke database
	 */
	public function store()
	{
		$this->validate([
			'id_item'		=> 'required',
			'date'			=> 'required',
			'qty'			=> 'required',
			'purchase_price'=> 'required',
		]);

		DB::transaction(function () {
			$stockItem = Goods::select('stock')->where('id', $this->id_item)->first()->stock ?? 0; // cek stock barang sekarang
			$sum = $stockItem + $this->qty; // tambahkan stock barang sekarang dan jumlah barang yang masuk

			Inventory::create([
				'id_item'		=> $this->id_item,
				'date'			=> $this->date,
				'qty'			=> $this->qty,
				'purchase_price'=> $this->purchase_price,
				'category'		=> 'In',
			]);

			Goods::where('id', $this->id_item)->first()->update([
				'stock'	=> $sum // ubah stock hasil tadi penjumlahan
			]);

			$this->resetInputFields(); // reset value inputan dengan value baru
			$this->dispatchBrowserEvent('swal:modal',
				[
					'type' 		=> __('messages.alert.type'),
					'message'	=> __('messages.alert.success'),
					'text'		=> __('messages.alert.created'),
				]
			);
			$this->emit('dataStore');
		});
	}

	/**
	 * @description function edit() untuk mengambil data dari database ke dalam inputan
	 */
	public function edit($id)
	{
		$this->updateMode = true;
		$data = Inventory::findOrFail($id);
		$this->dataId = $id;
		$this->id_item = $data->id_item;
		$this->date = $data->date;
		$this->qty = $data->qty;
		$this->purchase_price = $data->purchase_price;
	}

	/**
	 * @description function update() untuk mengubah data dari inputan ke dalam database
	 */
	public function update()
	{
		
		$this->validate([
			'id_item'		=> 'required',
			'date'			=> 'required',
			'qty'			=> 'required',
			'purchase_price'=> 'required',
		]);
		
		DB::transaction(function () {

			/**
			 * @example :
			 * Ambil jumlah stock pada id tersebut, 
			 * Contoh: 50;
			 */
			$qtyIn = Inventory::where('id', $this->dataId)->first()->qty;

			if( $this->qty >= $qtyIn) // jika jumlah stock baru lebih banyak dari jumlah stock pada database
			{
				/**
				 * @example :
				 * $this->qty = 80;
				 * $qtyIn = 50;
				 * $stockQty = 80-50 => 30;
				 * $stockItem = 50;
				 * $stockIn = 50 + 30 => 80;
				 */
				$stockQty = $this->qty - $qtyIn;
				$stockItem = Goods::where('id', $this->id_item)->first()->stock;
				$stockIn = $stockItem + $stockQty;
				Goods::where('id', $this->id_item)->first()->update(array('stock' => $stockIn));
			} else
			{
				/**
				 * @example :
				 * $this->qty = 30;
				 * $qtyIn = 50;
				 * $stockQty = 30 - 50 => -20;
				 * $stockItem = 50;
				 * $stockIn = 50 + (-20) => 30;
				 */
				$stockQty = $this->qty - $qtyIn; 
                $stockItem = Goods::where('id', $this->id_item)->first()->stock;
                $stockIn = $stockItem + $stockQty;
                Goods::where('id', $this->id_item)->first()->update(array('stock' => $stockIn));
			}

			if( $this->dataId )
			{
				$data = Inventory::findOrFail($this->dataId);
				$data->update([
					'id_item'		=> $this->id_item,
					'date'			=> $this->date,
					'qty'			=> $this->qty,
					'purchase_price'=> $this->purchase_price,
				]);

				$this->updateMode = false;
				$this->dispatchBrowserEvent('swal:modal', 
					[
						'type' 		=> __('messages.alert.type'),
						'message'	=> __('messages.alert.success'),
						'text'		=> __('messages.alert.updated'),
					]
				);
				$this->resetInputFields();
				$this->emit('dataStore');
			}

		});

		
	}
	
	/**
	 * @description function deleteConfirm() untuk menampilkan alert ketika menghapus data
	 * @param id = public $idRemoved;
	 */
	public function deleteConfirm($id)
	{
		$this->idRemoved = $id;
		$this->dispatchBrowserEvent('swal');
	}

	/**
	 * @description function delete() untuk menghapus data
	 */
	public function delete()
	{
		DB::transaction(function () {
			/**
			 * @description $data
			 * 	=> mengambil data dari table inventories
			 * 
			 * @description $id_item, $qty
			 * 	=> mengambil data id_item, qty dari table inventories
			 * 
			 * @description $stockItem
			 * 	=> mengambil data kolom stock pada table goods berdasarkan id_item
			 * 
			 * @example:
			 * $stockItem 	= 50;
			 * $qty			= 30;
			 * $stock		= 50 - 30 => 20;
			 */
			$data = Inventory::findOrFail($this->idRemoved);

			$id_item	= $data->id_item;
			$qty		= $data->qty;
			$stockItem	= Goods::select('stock')->where('id', $id_item)->first()->stock;
			$stock = $stockItem - $qty;

			Goods::where('id', $id_item)->first()->update(array('stock' => $stock));
			$data->delete();
		});
	}

	public function isUpdate($dataIDS)
	{
		$check = Inventory::select('id')->orderBy('updated_at', 'DESC')->latest()->first()->id;
		return $dataIDS == $check ? 'bg-light-50' : '';
	}
}
