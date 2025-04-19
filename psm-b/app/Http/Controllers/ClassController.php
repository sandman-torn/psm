<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassResource;
use Illuminate\Http\Request;
use App\Models\Classes;

class ClassController extends Controller
{
    public function __invoke()
    {
        return ClassResource::collection(Classes::all());
    }
}
