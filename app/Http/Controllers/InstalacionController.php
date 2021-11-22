<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Device;
use App\Models\Instalacion;
use Illuminate\Http\Request;

class InstalacionController extends Controller
{
    public function index(){
        $instalaciones = Instalacion::with('equipo')->with('aplicacion')->get();
        return $instalaciones;
    }

    public function perApplication($nombre, $version){
        $app = App::where('nombre', $nombre)->where('version', $version)->first()->ID;
        $instalacion = Instalacion::with('equipo')->with('aplicacion')->where('id_app', $app)->get();
        return $instalacion;
    }

    public function perStation($estacion){
        $equipo = Device::where('estacion', $estacion)->first()->id;
        $instalacion = Instalacion::with('equipo')->with('aplicacion')->where('id_eq', $equipo)->get();
        return $instalacion;
    }

    public function store(Request $request){
        $equipo = Device::where('estacion', $request->estacion)->first();
        if($equipo->can_install){
            $data = [
                'id_eq' => $equipo->id,
                'id_app' => App::where('nombre', $request->app)->where('version', $request->version)->first()->ID
            ];
            if($request->instalacion){
                $data['fec_inst'] = $request->instalacion;
            }
            $instalacion = Instalacion::create($data);
            return response()->json([
                'msg' => "Se agrego la instalacion",
                'inserted' => Instalacion::with('equipo')->with('aplicacion')->where('id_eq', $instalacion->id_eq)->where('id_app', $instalacion->id_app)->first()
            ]);
        }else{
            return response("No se pueden instalar aplicaciones", 400);
        }
    }

    public function destroy($estacion, $app, $version){
        $equipo = Device::where('estacion', $estacion)->first()->id;
        $app = App::where('nombre', $app)->where('version', $version)->first()->ID;
        Instalacion::where('id_eq', $equipo)->where('id_app', $app)->delete();
    }
}
