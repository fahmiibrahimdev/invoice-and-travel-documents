<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoQuot extends Model
{
    use HasFactory;
	protected $table = 'no_quots';
	protected $guarded = [];
}
