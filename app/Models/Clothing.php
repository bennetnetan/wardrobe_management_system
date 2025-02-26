<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    protected $fillable = ['name', 'description', 'price', 'quantity', 'category'];
}