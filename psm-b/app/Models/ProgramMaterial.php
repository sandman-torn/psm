<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMaterial extends Model
{
    protected $fillable = [
        'program_id',
        'material_name',
        'file_url',

    ];
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
