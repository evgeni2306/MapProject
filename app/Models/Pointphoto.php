<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointphoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'pointid',
        'photo1',
        'photo2',
        'photo3'
    ];
}
