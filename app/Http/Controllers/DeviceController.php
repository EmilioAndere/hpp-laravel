<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(){
        $devices = Device::all();
        return $devices;
    }

    public function show($attr, $search){
        $attr = $attr === 'serie' ? 'num_serie' : $attr;
        $device = Device::where($attr, $search)->first();
        return $device;
    }

    public function store(Request $req){
        $device = Device::firstOrNew(
            ['estacion' => $req->estacion],
            [
                'num_serie' => $req->serie,
                'compra' => $req->compra, 
                'especificaciones' => $req->espe, 
                'tipo' => $req->tipo,
                'id_sede' => $req->sede
            ]
        );
        if($device->ID){
            return $device;
        }else{
            $device->save();
            return $device->id;
        }
    }

    public function update(Request $req, $estacion){
        $device = Device::where('estacion', $estacion)
            ->update([
                'num_serie' => $req->serie,
                'estacion' => $req->estacion,
                'compra' => $req->compra, 
                'especificaciones' => $req->espe, 
                'tipo' => $req->tipo,
                'id_sede' => $req->sede
            ]);
        return $device;
    }

    public function destroy($estacion){
        $affectedRow = Device::where('estacion', $estacion)->delete();
        return $affectedRow;
    }
}
