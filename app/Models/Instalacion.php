<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{

    protected $table = "instalacion";
    public $timestamps = false;

    protected $fillable = [
        'id_eq',
        'id_app',
        'fec_inst'
    ];
   
    public function equipo(){
        return $this->hasOne(Device::class, 'id', 'id_eq');
    }

    public function aplicacion(){
        return $this->hasOne(App::class, 'ID', 'id_app');
    }

}
