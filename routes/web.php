<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\IncomingGoods\IncomingGoods;
use App\Http\Livewire\Item\MasterItem;
use App\Http\Livewire\StockOfGoods\StockOfGoods;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {
	Route::get('dashboard', Dashboard::class)->name('dashboard');
});

Route::group(['middleware' => ['auth', 'role:admin']], function() {
	Route::get('master-item', MasterItem::class)->name('master-item');
	Route::get('incoming-goods', IncomingGoods::class)->name('incoming-goods');
	Route::get('stock-of-goods', StockOfGoods::class)->name('stock-of-goods');
});

Route::group(['middleware' => ['auth', 'role:user']], function() {

});

require __DIR__.'/auth.php';
