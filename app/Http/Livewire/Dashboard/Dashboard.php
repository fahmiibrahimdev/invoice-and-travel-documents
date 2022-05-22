<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{
    public function render()
    {
		if(Auth::user()->hasRole('admin'))
		{
			
			return view('livewire.dashboard.dashboard-admin')
			->extends('layouts.apps', ['title' => 'Dashboard']);
		}

    }
}
