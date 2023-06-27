<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Document extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'texto',
        'createBy',
    ];
    use HasFactory;
    use SoftDeletes;

    public function usuarios()
    {
        return $this->belongsToMany(User::class);
    }


    // Relacionamento com os usuários que têm permissão para acessar o documento
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'createBy');
    }
}
