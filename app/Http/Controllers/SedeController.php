<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function index(){
        $sede = Sede::all();
        return $sede;
    }
}
