<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'category_products';
    
    protected $fillable = [
        'name',
        'description',
    ];
}