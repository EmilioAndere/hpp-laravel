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
    
    public function show($name){
        $app = DB::table('aplicaciones')
            ->where('nombre', $name)->get();
        return $app;
    }

    public function store(Request $req){
        $app = App::firstOrNew(
            ['nombre' => $req->nombre],
            ['version' => $req->version, 'fec_compra' => $req->compra]
        );
        if($app->ID)
            return $app;
        else
            $app->save();
            return $app->id;
    }

    public function update(Request $req, $name){
        $app = App::where('nombre', $name)
            ->update([
                'nombre' => $req->nombre,
                'version' => $req->version,
                'fec_compra' => $req->compra
            ]);
        return $app;
    }

    public function destroy($name){
        $affectedRows = App::where('nombre', $name)->delete();
        return $affectedRows;
    }
}