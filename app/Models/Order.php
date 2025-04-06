<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'orders';

    protected $fillable = [
        'date_time',
        'client_id',
        'vendor_id',
        'total',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class);
    }
}