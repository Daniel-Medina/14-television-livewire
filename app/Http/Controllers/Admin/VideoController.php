<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Canal;
use App\Models\Lista;
use App\Models\Plataforma;
use App\Models\Plataforma_id;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VideoController extends Controller
{

    public function index()
    {
        //
        $this->authorize('access', Video::class);
        //Validar si el usuario tiene canal
        if (Auth::user()->canal == null) {
            //Si no tiene canal crear un canal
            Canal::create([
                'clave' => \uniqid(),
                'descripcion' => 'Hola este es mi canal',
                'user_id' => \auth()->id(),
            ]);
        }

        return \view('admin.videos.index');
    }

    public function create()
    {
        //
        $this->authorize('create', Video::class);

        $plataformas = Plataforma::pluck('nombre', 'id');
        $listas = Lista::where('user_id', \auth()->id())->get();

        return \view('admin.videos.create', \compact('plataformas', 'listas'));
    }

    public function store(Request $request)
    {
        //
        $this->authorize('create', Video::class);

        //Reglas de validacion
        $reglas = [
            'imagen' => 'nullable|image',
            'nombre' => 'required|min:8|max:250|unique:videos',
            'descripcion' => 'required|min:8|max:3000',
            'url' => ['required', 'regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x'],
            'plataforma_id' => 'required',
        ];

        //Validar la plataforma_id
        if ($request->plataforma_id == 1) {
            $reglas['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }

        //Validar
        $this->validate($request, $reglas);

        //Crear el iframe con la plataforma_id
        $iframe = $this->makeIframe($request->url, $request->plataforma_id);

        //variables necesarias
        $disponible = 'no';
        $img = '';

        //Validar si va estar disponible
        if ($request->disponible == 'si') {
            $disponible = 'si';
        }

        //Validar si va ser portada el video
        $portada = 'no';

        if ($request->principal == 'si') {
            $portada = 'si';
        }


        //Almacenar la imagen
        if ($request->hasFile('imagen')) {
            $img = $request->file('imagen')->store('miniaturas', 'public');
        }

        //Verificar que no exista una entrada como portada
        if ($portada == 'si') {
            $video = Video::where('portada', 'si')->get()->first();
            if ($video) {
                $video->portada = 'no';
                $video->save();
            }
        }

        // generar el slug correspondiente
        $slug = Str::slug($request->nombre, '-');

        $video = Video::create([
            'nombre' => $request->nombre,
            'slug' => $slug,
            'descripcion' => $request->descripcion,
            'portada' => $portada,
            'disponible' => $disponible,
            'url' => $request->url,
            'iframe' => $iframe,
            'miniatura' => $img,
            'plataforma_id' => $request->plataforma_id,
            'canal_id' => Auth::user()->canal->id,
        ]);

        //Actualizar las listas seleccionadas
        $video->listas()->sync($request->listas);

        return \redirect()
            ->route('admin.videos.index')
            ->with([
                'flash.banner' => 'El video se ha creado con éxito',
                'flash.bannerStyle' => 'success'
            ]);
    }

    public function edit(Video $video)
    {
        //
        $this->authorize('update', $video);

        $plataformas = Plataforma::pluck('nombre', 'id');
        $listas = Lista::where('user_id', \auth()->id())->get();

        return \view('admin.videos.edit', \compact('video', 'plataformas', 'listas'));
    }

    public function update(Request $request, Video $video)
    {
        $this->authorize('update', $video);

        //Reglas de validacion
        $reglas = [
            'imagen' => 'nullable|image',
            'nombre' => 'required|min:8|max:250|unique:videos,nombre,' . $video->id,
            'descripcion' => 'required|min:8|max:3000',
            //reglas de validacion de youtube
            'url' => ['required', 'regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x'],
            'plataforma_id' => 'required',
        ];

        //Validar si se escogio vimeo
        if ($request->plataforma_id == 1) {
            $reglas['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }


        $this->validate($request, $reglas);

        //generar el iframe
        $iframe = $this->makeIframe($request->url, $request->plataforma_id);


        //Actualizar los datos del formulario
        DB::beginTransaction();

        $disponible = 'no';

        if ($request->disponible == 'si') {
            $disponible = 'si';
        }

        $portada = 'no';

        if ($request->principal == 'si') {
            $portada = 'si';
        }

        try {
            //Almacenar la imagen
            $img = $video->miniatura;

            if ($request->hasFile('imagen')) {
                $img = $request->file('imagen')->store('miniaturas', 'public');
                //Validar la imagen anterior
                if ($video->imagen != '/storage/no-img.jpg') {
                    \unlink(\public_path($video->imagen));
                }
            }
            //Verificar que no exista una entrada como portada
            if ($portada == 'si') {
                $filtro = Video::where('portada', 'si')->where('id', '!=', $video->id)->get()->first();
                if ($filtro) {
                    $filtro->portada = 'no';
                    $filtro->save();
                }
            }

            //generar el slug nuevo
            $slug = Str::slug($request->nombre, '-');


            $video->update([
                'nombre' => $request->nombre,
                'slug' => $slug,
                'descripcion' => $request->descripcion,
                'portada' => $portada,
                'disponible' => $disponible,
                'miniatura' => $img,
                'url' => $request->url,
                'iframe' => $iframe,
                'plataforma_id' => $request->plataforma_id,
            ]);

            $video->listas()->sync($request->listas);



            DB::commit();

            return \redirect()
                ->route('admin.videos.index')
                ->with([
                    'flash.banner' => 'El video se ha actualizado con éxito',
                    'flash.bannerStyle' => 'success'
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \abort('500', 'Ocurrio un error');
        }
    }

    public function destroy(Video $video)
    {
        $this->authorize('delete', $video);

        //Validar que la imagen no sea la del accesor y eliminarla
        if ($video->imagen != '/storage/no-img.jpg') {
            \unlink(\public_path($video->imagen));
        }

        $video->delete();

        return \redirect()
            ->route('admin.videos.index')
            ->with([
                'flash.banner' => 'El video se ha eliminado con éxito',
                'flash.bannerStyle' => 'success'
            ]);
    }

    private function makeIframe($url, $plataforma): String
    {
        $iframe = '';

        if ($plataforma == 1) {
            $patron = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            $array = preg_match($patron, $url, $parte);
            $iframe = '<iframe src="https://player.vimeo.com/video/' . $parte[2] . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
        } else {
            $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';
            $array = preg_match($patron, $url, $parte);
            $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $parte[1] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }

        return $iframe;
    }
}
