<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rpoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'lat',
        'lng',
        'routeid'
    ];
    protected $hidden = [
    ];
}
