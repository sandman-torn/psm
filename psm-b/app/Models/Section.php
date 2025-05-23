<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;

    public function class()
    {
        return $this->belongsTo(Classes::class, "class_id");
    }

    public function student()
    {
        return $this->hasMany(Student::class, "section_id");
    }

}
