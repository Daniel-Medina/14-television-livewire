<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
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
                ->get()
                ->first() ?? Video::where('disponible', 'si') #validar si existen videos publicos
                ->get()
                ->count() > 0 ? Video::where('disponible', 'si')
                ->get()
                ->random() : []; # Si no existen devolver un array vacio
        } else {
            $videoPortada = [];
        }

        $videos = Video::orderBy('vistas', 'desc')->where('disponible', 'si')->get()->take(5);

        return \view('home.root', \compact('videoPortada', 'videos'));
    }

    public function index()
    {
        $videos = Video::where('disponible', 'si')
                        ->paginate(30);

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

        return view('home.videos.show', \compact('video', 'similares'));
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
