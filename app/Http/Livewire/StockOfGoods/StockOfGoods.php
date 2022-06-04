<?php

namespace App\Http\Livewire\StockOfGoods;

use App\Models\Goods;
use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;

class StockOfGoods extends Component
{
	use WithPagination;
	protected $listeners = [
		'deleteConfirmed'	=> 'delete',
	];
	public $name_of_goods, $item_code, $price_of_goods;
	public $dataInventory = [];
	public $searchTerm, $lengthData;
	protected $paginationTheme = 'bootstrap';
	
    public function render()
    {
		$searchTerm = '%'.$this->searchTerm.'%';
		$lengthData = $this->lengthData;

		$data = Goods::from('goods as a')
					->select('a.*')
					->join('inventories as b', 'b.id_item', 'a.id')
					->where('b.category', 'In')
					->where(function($query) use ($searchTerm){
						$query->where('a.name_of_goods', 'LIKE', $searchTerm);
						$query->orWhere('a.item_code', 'LIKE', $searchTerm);
						$query->orWhere('a.item_unit', 'LIKE', $searchTerm);
						$query->orWhere('a.stock', 'LIKE', $searchTerm);
					})
					->orderBy('a.id', 'DESC')
					->paginate($lengthData);

        return view('livewire.stock-of-goods.stock-of-goods', compact('data'))
		->extends('layouts.apps', ['title' => 'Stock Of Goods']);
    }

	public function view($id)
	{
		$dataInventories = Inventory::where('id_item', $id)->get();
		$this->dataInventory = $dataInventories;
		$items = Goods::where('id', $id)->first();
		$this->name_of_goods = $items->name_of_goods;
		$this->item_code = $items->item_code;
		$this->price_of_goods = $items->price_of_goods;
	}
}
