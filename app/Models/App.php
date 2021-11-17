<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $table = 'aplicaciones';
    public $timestamps = false;

    protected $fillable = ['nombre', 'version', 'fec_compra'];
}
