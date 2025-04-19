<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['unit'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
