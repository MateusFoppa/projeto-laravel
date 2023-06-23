<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'texto',
        'createBy',
    ];
    use HasFactory;
}
