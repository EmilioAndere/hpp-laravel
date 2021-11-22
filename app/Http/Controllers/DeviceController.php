<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function index(){
        $equipos = Device::with('sede')->get();
        return $equipos;
    }

    public function show($attr, $search){
        $attr = $attr === 'serie' ? 'num_serie' : $attr;
        $equipo = Device::with('sede')->where($attr, '=', $search)->first();
        return $equipo;
    }

    public function store(Request $req){
        $device = Device::create([
            'num_serie' => $req->num_serie,
            'compra' => $req->compra,
            'especificaciones' => $req->especificaciones,
            'estacion' => Device::all()->last()->estacion + 1,
            'tipo' => $req->tipo,
            'id_sede' => Sede::where('nombre', $req->sede)->first()->ID
        ]);

        return response()->json([
            'msg' => "Se agrego el registro con ID => $device->id",
            'inserted' => $device
        ]);
    }

    public function update(Request $request, $id){
        $device = Device::find($id);
        
        $device->num_serie = $request->num_serie;
        $device->compra = $request->compra;
        $device->especificaciones = $request->especificaciones;
        $device->estacion = $request->estacion;
        $device->tipo = $request->tipo;
        $device->id_sede = Sede::where('nombre', $request->sede)->first()->ID;
        
        if($device->isDirty()){
            $changes = $device->getDirty();
            $affected = $device->save();
            if($affected == 1){
                return response()->json([
                    'updated' => true,
                    'changes' => $changes,
                    'msg' => "Se actualizaron $affected filas"
                ]);
            }else{
                return response("No se han realizado cambios", 400);
            }
        }else{
            return response("No se han realizado cambios", 400);
        }
    }

    public function destroy($estacion){
        $affectedRow = Device::where('estacion', $estacion)->delete();
        if($affectedRow == 1){
            return response()->json([
                'msg' => "Deleted $affectedRow rows"
            ], 200);
        }else{
            return response()->json([
                'msg' => "No se ha eliminado ningun registro"
            ], 400);
        }
    }
}
