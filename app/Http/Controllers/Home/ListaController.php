<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Lista;
use App\Models\Video;
use App\Models\Vista;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    //
    public function index()
    {
        $listas = Lista::where('disponible', 'si')->get();

        return \view('home.listas.index', \compact('listas'));
    }

    public function show(Lista $lista)
    {
        if ($lista->disponible == 'no') {
            return \abort(404);
        }
        
        return \view('home.listas.show', \compact('lista'));

    }

    public function details(Lista $lista, Video $video)
    {
        //Verificar si existe el video en la lista
        $encontrado = false;
        #Crear la lista de similares
        $similares = (object) [];
        $count = 0;


        foreach ($lista->videos as $v) {
            //Validar si hay coincidencias
            if ($v->id == $video->id) {
                //Si se encuentra cambiar la bandera a true y omitir el video en la lista
                $encontrado = true;
            } else {
                //Agregar videos a la lista
                $similares->$count  = $v;
                $count++;
            }
        }


        //Si se encuentra regresar la lista
        if ($encontrado) {
            //Actualizar las vistas
            $this->addView($video);
            //Regresar la vista
            return view('home.listas.video', \compact('lista', 'video', 'similares'));

        } else {
            //Si no se encuentra devolver un error
            return \redirect()->route('root')->with([
                'flash.banner' => 'Ocurrío un error intente de nuevo',
                'flash.bannerStyle' => 'danger'
            ]);
        }
    }

    //Agregar vista a un video
    private function addView(Video $video)
    {
        $video->vistas++;
        $video->save();

        //Actualizar las vistas unitarias
        $fecha = Carbon::now()->format('y-m-d');
        $vista = Vista::where('created_at','LIKE' ,'%'. $fecha . '%')->get()->first() ?? [];

        if ($vista == []) {
            $vista = Vista::create([
                'vistas' => 1
            ]);
        } else {
            $vista->vistas++;
            $vista->save();
        }
    }
}
