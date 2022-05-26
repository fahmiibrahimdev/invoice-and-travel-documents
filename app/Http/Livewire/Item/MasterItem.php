<?php

namespace App\Http\Livewire\Item;

use App\Models\Goods;
use Livewire\Component;
use Livewire\WithPagination;

class MasterItem extends Component
{
	use WithPagination;
	protected $listeners = [
		'deleteConfirmed' => 'delete'
	];
	public $name_of_goods, $item_code, $item_unit, $price_of_goods, $types_of_goods;
	public $searchTerm, $lengthData;
	public $updateMode = false;
	public $idRemoved = NULL;
	public $paginationTheme = 'bootstrap';

	public function mount()
	{
		$this->name_of_goods = '';
		$this->item_code = '';
		$this->item_unit = '';
		$this->price_of_goods = 0;
		$this->types_of_goods = NULL;
	}

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
	
	public function deleteConfirm($id)
	{
		$this->idRemoved = $id;
		$this->dispatchBrowserEvent('swal');
	}

	public function delete()
	{
		Goods::findOrFail($this->idRemoved)->delete();
	}

}
