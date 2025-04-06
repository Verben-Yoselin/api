<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'clients';

    protected $fillable = [
        'id',
        'join_date_time',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'id');
    }
}