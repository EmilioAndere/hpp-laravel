<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function index(){
        $app = App::all();
        return $app;
    }
    
    public function show($name, $version = null){
        if(is_null($version)){
            $app = App::where('nombre', $name)->get();
        }else{
            $app = App::where('nombre', $name)->where('version', $version)->first();
        }
        return $app;
    }

    public function store(Request $req){
        $app = App::firstOrCreate(
            ['nombre' => $req->nombre, 'version' => $req->version],
            ['fec_compra' => $req->compra]
        );

        if($app->ID)
            return $app;
        else
            $app->save();
            return $app->id;
    }

    public function update(Request $req, $name, $version){
        $app = App::where('nombre', $name)->where('version', $version)->first();

        $app->nombre = $req->nombre;
        $app->version = $req->version;
        $app->fec_compra = $req->compra;

        if($app->isDirty()){
            $changes = $app->getDirty();
            $affected = $app->save();
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

    public function destroy($name, $version){
        $affectedRows = App::where('nombre', $name)->where('version', $version)->delete();
        return response("Deleted $affectedRows rows");
    }
}