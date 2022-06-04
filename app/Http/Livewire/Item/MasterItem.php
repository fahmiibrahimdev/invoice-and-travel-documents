<?php

namespace App\Http\Livewire\Item;

use App\Models\Goods;
use Livewire\Component;
use Livewire\WithPagination;

class MasterItem extends Component
{
	use WithPagination;
	protected $listeners = [
		'deleteConfirmed' => 'delete',
		'deleteCheckedData',
	];
	public $name_of_goods, $item_code, $item_unit, $price_of_goods, $types_of_goods;
	public $searchTerm, $lengthData; // search dan sorting
	public $updateMode = false;
	public $idRemoved = NULL; // mendifinisikan id untuk hapus data
	public $paginationTheme = 'bootstrap'; // mendifinisikan pagination bertema bootstrap
	public $checkedId = []; // menghapus data banyak yang ditampung ke array


	/**
	 * @description function mount() untuk mengisi value dari inputan
	 * @see https://laravel-livewire.com/docs/2.x/rendering-components
	 */
	public function mount()
	{
		$this->name_of_goods = '';
		$this->item_code = '';
		$this->item_unit = '';
		$this->price_of_goods = 0;
		$this->types_of_goods = NULL;
	}

	/**
	 * @description function resetInputFields() untuk mereset value inputan, dan menggantikan value baru
	 * @see https://laravel-livewire.com/docs/2.x/properties
	 */
	public function resetInputFields()
	{
		$this->name_of_goods = '';
		$this->item_code = '';
		$this->price_of_goods = 0;
		$this->types_of_goods = NULL;
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

		$data = Goods::where('name_of_goods', 'LIKE', $searchTerm)
					->orWhere('item_code', 'LIKE', $searchTerm)
					->orWhere('item_unit', 'LIKE', $searchTerm)
					->orWhere('price_of_goods', 'LIKE', $searchTerm)
					->orWhere('types_of_goods', 'LIKE', $searchTerm)
					->orderBy('id', 'ASC')
					->paginate($lengthData); 

        return view('livewire.item.master-item', compact('data'))
		->extends('layouts.apps', ['title' => 'Data Master Item']);
    }

	/**
	 * @description function store() untuk store data dari inputan ke database
	 */
	public function store()
	{
		$this->validate([
			'name_of_goods'		=> 'required',
			'item_code'			=> 'required',
			'item_unit'			=> 'required',
			'price_of_goods'	=> 'required',
			'types_of_goods'	=> 'required',
		]);

		Goods::create([
			'name_of_goods'		=> $this->name_of_goods,
			'item_code'			=> $this->item_code,
			'item_unit'			=> $this->item_unit,
			'price_of_goods'	=> $this->price_of_goods,
			'types_of_goods'	=> $this->types_of_goods,
		]);

		$this->resetInputFields();
		$this->dispatchBrowserEvent('swal:modal',
			[
				'type' 		=> __('messages.alert.type'),
				'message'	=> __('messages.alert.success'),
				'text'		=> __('messages.alert.created'),
			]
		);
		$this->emit('dataStore');
	}

	/**
	 * @description function edit() untuk mengambil data dari database ke dalam inputan
	 */
	public function edit($id)
	{
		$this->updateMode = true;
		$data = Goods::findOrFail($id);
		$this->dataId = $id;
		$this->name_of_goods = $data->name_of_goods;
		$this->item_code = $data->item_code;
		$this->item_unit = $data->item_unit;
		$this->price_of_goods = $data->price_of_goods;
		$this->types_of_goods = $data->types_of_goods;
	}

	/**
	 * @description function update() untuk mengubah data dari inputan ke dalam database
	 */
	public function update()
	{
		$this->validate([
			'name_of_goods'		=> 'required',
			'item_code'			=> 'required',
			'item_unit'			=> 'required',
			'price_of_goods'	=> 'required',
			'types_of_goods'	=> 'required',
		]);

		if( $this->dataId )
		{
			$data = Goods::findOrFail($this->dataId);
			$data->update([
				'name_of_goods'		=> $this->name_of_goods,
				'item_code'			=> $this->item_code,
				'item_unit'			=> $this->item_unit,
				'price_of_goods'	=> $this->price_of_goods,
				'types_of_goods'	=> $this->types_of_goods,
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
		Goods::findOrFail($this->idRemoved)->delete();
		$this->checkedId = [];
	}

	/**
	 * @description function deleteData() untuk menampilkan alert ketika menghapus pada data tertentu
	 */
	public function deleteData()
	{
		$this->dispatchBrowserEvent('swal:deleteChecked', [
			'checkedIDs'	=> $this->checkedId
		]);
	}

	/**
	 * @description function deleteData() untuk menghapus data tertentu dengan whereKey({id})
	 */
	public function deleteCheckedData($ids)
	{
		Goods::whereKey($ids)->delete();
		$this->checkedId = [];
	}

	/**
	 * @description function deleteData() untuk mengubah tampilan background pada table jika data ada yang dipilih
	 */
	public function isChecked($dataIDs)
	{
		return in_array($dataIDs, $this->checkedId) ? 'bg-light' : '';
	}

}
