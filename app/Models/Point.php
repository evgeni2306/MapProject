<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'creatorid',
        'lat',
        'lng',
        'name',
        'address',
        'type',
        'description',
        'rating'
    ];
    protected $hidden = [
    ];
}
