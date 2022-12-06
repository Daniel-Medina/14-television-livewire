<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Video;
use App\Models\Vista;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    //
    public function __invoke()
    {
        //Verificar si existen videos
        if (Video::all()->count() > 0) {
            //Obtener el primer video
            $videoPortada = Video::where('portada', 'si')
                ->where('disponible', 'si')
                ->get()->first(); 

                // si el video esta vacio
                if ($videoPortada == null) {
                    //Obtener un video al azar
                    $videoPortada = Video::where('disponible', 'si')
                        ->get()
                        ->random();
                }

        } else {
            $videoPortada = [];
        }

        $videos = Video::orderBy('vistas', 'desc')->where('disponible', 'si')->get()->take(5);

        return \view('home.root', \compact('videoPortada', 'videos'));
    }

    public function index()
    {
        $videos = Video::orderBy('id', 'desc')
                        ->where('disponible', 'si')
                        ->paginate(6);

        return \view('home.videos.index', \compact('videos'));
    }

    public function show(Video $video)
    {
        if ($video->disponible == 'no') {
            return \abort(404);
        }
        
        $similares = Video::where('disponible', 'si')
                            ->where('id', '!=', $video->id)
                            ->get()
                            ->take(4);

        //Actualizar el contador
        $this->addView($video);

        //Recuperar la configuracion de comentarios
        $comentarios = Config::find(1)->comentarios;

        return view('home.videos.show', \compact('video', 'similares', 'comentarios'));
    }

    //Agregar vista a un video
    private function addView(Video $video)
    {
        //Actualizar las vistas por video
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
