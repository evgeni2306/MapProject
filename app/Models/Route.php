<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = [
        'creatorid',
        'status',
        'name',
        'type',
        'icon',
        'city',
        'shortdescription',
        'description',
        'difficult',
        'distance',
        'time',
        'rating',
    ];
    protected $hidden = [
    ];
}
