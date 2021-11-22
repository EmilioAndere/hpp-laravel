<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = "equipos";
    public $timestamps = false;

    protected $fillable = [
        'estacion',
        'num_serie',
        'compra',
        'especificaciones',
        'tipo',
        'id_sede'
    ];

    public function sede(){
        return $this->belongsTo(Sede::class, 'id_sede');
    }
}
