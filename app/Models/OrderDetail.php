<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    // Indica que no se usará la llave primaria autoincremental ya que se usa una llave compuesta.
    public $incrementing = false;
    // Deshabilita timestamps si no se usan en esta tabla.
    public $timestamps = false;
    // No se define un primaryKey único, pues se compone de order_id y product_id.
    protected $primaryKey = null;

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'price'
    ];

    // Relación con Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Relación con Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}