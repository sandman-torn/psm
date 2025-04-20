<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMaterial extends Model
{
    public function program()
{
    return $this->belongsTo(Program::class);
}
}
