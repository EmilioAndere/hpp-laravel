<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $table = 'sede';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'nombre'
    ];

    public function equipos(){
        return $this->hasMany(Device::class, 'id_sede');
    }
}
