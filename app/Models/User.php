<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    // Campos que podem ser preenchidos via create()
    protected $fillable = [
        'username',
        'password',
        'last_login',
    ];

    // Evita que a senha seja mostrada em arrays ou JSON
    protected $hidden = [
        'password',
    ];

    // Relacionamento com notas
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
