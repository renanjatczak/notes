<?php

namespace App\Models;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
