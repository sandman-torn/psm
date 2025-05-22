<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Participant extends Model
{
    protected $table = 'participants'; // likely this, if not declared Laravel assumes 'participants'


    protected $fillable = [
        'user_id',
        'program_id',
        'certificate_code',
        'is_walkin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
