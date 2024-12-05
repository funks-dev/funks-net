<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodDrink extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'name', 'description', 'image', 'price',
    ];
}