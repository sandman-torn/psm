<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    use HasFactory;

    protected $fillable = [
        'program_name',
        'created_by',
        'by_unit',
        'program_desc',
        'date_from',
        'date_to',
        'location',
        'url',
        'time_from',
        'time_to',

    ];

    public function materials()
    {
        return $this->hasMany(ProgramMaterial::class);
    }

    public function participants()
    {
        //return $this->hasMany(Participant::class);
        //return $this->belongsToMany(User::class, 'participants', 'program_id', 'user_id', 'id');
        return $this->hasMany(\App\Models\Participant::class);


    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function unit()
    {
        return $this->belongsTo(Unit::class, 'by_unit');
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
