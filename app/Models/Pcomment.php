<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcomment extends Model
{
    use HasFactory;
    protected $fillable = [
        'creatorid',
        'pointid',
        'rating',
        'text'

    ];
    protected $hidden = [
    ];
}
