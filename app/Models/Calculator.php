<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculator extends Model
{
    use HasFactory;

    protected $fillable = [
        'bilangan1',
        'operator',
        'bilangan2',
        'hasil',
    ];
}
