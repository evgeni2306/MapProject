<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rcomment extends Model
{
    use HasFactory;
    protected $fillable = [
        'creatorid',
        'routeid',
        'rating',
        'text'

    ];
    protected $hidden = [
    ];
}
