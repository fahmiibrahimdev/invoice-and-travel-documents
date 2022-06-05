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
	public $name_of_goods, $item_code, $price_of_goods, $idDataInventory;
	public $searchTerm, $lengthData;
	protected $paginationTheme = 'bootstrap';
	
    public function render()
    {
		$searchTerm = '%'.$this->searchTerm.'%';
		$lengthData = $this->lengthData;
		$dataInventory = Inventory::where('id_item', $this->idDataInventory)->paginate(15,['*'], 'inventories');
		$totalQty = Inventory::where('id_item', $this->idDataInventory)->sum('qty');
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
					->groupBy('a.id')
					->paginate($lengthData, ['*'], 'goods');

        return view('livewire.stock-of-goods.stock-of-goods', compact('data', 'dataInventory', 'totalQty'))
		->extends('layouts.apps', ['title' => 'Stock Of Goods']);
    }

	public function view($id)
	{
		$this->idDataInventory = $id;
		$items = Goods::where('id', $id)->first();
		$this->name_of_goods = $items->name_of_goods;
		$this->item_code = $items->item_code;
		$this->price_of_goods = $items->price_of_goods;
	}
}
