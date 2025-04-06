<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'url_picture',
        'category_id',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}