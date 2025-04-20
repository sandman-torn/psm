<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
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
