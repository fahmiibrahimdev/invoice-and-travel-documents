<?php

namespace App\Http\Livewire\Pbo;

use App\Models\ProjectNonPo;
use Livewire\Component;
use Livewire\WithPagination;

class Pbo extends Component
{
	use WithPagination;
	protected $listeners = [
		'deleteConfirmed' => 'delete',
		'deleteCheckedData',
	];
	public $description, $qty, $po, $amount, $department, $status;
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
		$this->description = '';
		$this->qty = 1;
		$this->po = 'SN';
		$this->amount = 0;
		$this->department = '';
		$this->status = 'Belum PO';
	}

	/**
	 * @description function resetInputFields() untuk mereset value inputan, dan menggantikan value baru
	 * @see https://laravel-livewire.com/docs/2.x/properties
	 */
	public function resetInputFields()
	{
		$this->description = '';
		$this->qty = 1;
		$this->amount = 0;
		$this->department = '-';
		$this->status = 'Belu PO';
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
		$data = ProjectNonPo::where('description', 'LIKE', $searchTerm)
					->orWhere('qty', 'LIKE', $searchTerm)
					->orWhere('po', 'LIKE', $searchTerm)
					->orWhere('amount', 'LIKE', $searchTerm)
					->orWhere('total', 'LIKE', $searchTerm)
					->orWhere('department', 'LIKE', $searchTerm)
					->orderBy('id', 'DESC')
					->paginate($lengthData);

        return view('livewire.pbo.pbo', compact('data'))
		->extends('layouts.apps', ['title' => 'Data Project Non PO']);
    }

	/**
	 * @description function store() untuk store data dari inputan ke database
	 */
	public function store()
	{

		$this->validate([
			'description' 	=> 'required',
			'qty' 			=> 'required',
			'po' 			=> 'required',
			'amount' 		=> 'required',
			'department' 	=> 'required',
			'status' 		=> 'required',
		]);

		$total = (int)$this->qty * (int)$this->amount;

		ProjectNonPo::create([
			'description'	=> $this->description,
			'qty'			=> $this->qty,
			'po'			=> $this->po,
			'amount'		=> $this->amount,
			'total'			=> $total,
			'department'	=> $this->department,
			'status'		=> $this->status,
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
		$this->updateMode 	= true;
		$data = ProjectNonPo::findOrFail($id);
		$this->dataId 		= $id;
		$this->description 	= $data->description;
		$this->qty 			= $data->qty;
		$this->po 			= $data->po;
		$this->amount 		= $data->amount;
		$this->department 	= $data->department;
		$this->status 		= $data->status;
	}
	
	/**
	 * @description function update() untuk mengubah data dari inputan ke dalam database
	 */
	public function update()
	{
		$this->validate([
			'description' 	=> 'required',
			'qty' 			=> 'required',
			'po' 			=> 'required',
			'amount' 		=> 'required',
			'department' 	=> 'required',
			'status' 		=> 'required',
		]);

		$total = (int)$this->qty * (int)$this->amount;

		if($this->dataId)
		{
			$data = ProjectNonPo::findOrFail($this->dataId);
			$data->update([
				'description'	=> $this->description,
				'qty'			=> $this->qty,
				'po'			=> $this->po,
				'amount'		=> $this->amount,
				'total'			=> $total,
				'department'	=> $this->department,
				'status'		=> $this->status,
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
		ProjectNonPo::findOrFail($this->idRemoved)->delete();
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
		ProjectNonPo::whereKey($ids)->delete();
		$this->checkedId = [];
	}

	/**
	 * @description function deleteData() untuk mengubah tampilan background pada table jika data ada yang dipilih
	 */
	public function isChecked($dataIDs)
	{
		return in_array($dataIDs, $this->checkedId) ? 'bg-light-50' : '';
	}


}
