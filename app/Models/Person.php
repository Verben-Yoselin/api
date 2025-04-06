<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'persons';

    protected $fillable = [
        'name',
        'pat_surname',
        'mat_surname',
        'fullname',
        'ci',
        'birthdate',
        'phone_number',
        'direction',
        'coordinates',
        'url_picture',
    ];
}