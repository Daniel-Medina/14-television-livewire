<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lista;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ListaController extends Controller
{
   
    public function index()
    {
        //
        $this->authorize('access', Lista::class);

        //Recuperar las listas que tiene el usuario
        $listas = Lista::orderBy('nombre', 'desc')->where('user_id', \auth()->id())->get();

        return \view('admin.listas.index', \compact('listas'));
    }

    public function create()
    {
        //
        $this->authorize('create', Lista::class);

        return \view('admin.listas.create');
    }

    public function store(Request $request)
    {
        //
        $this->authorize('create', Lista::class);

        $request->validate([
            'nombre' => 'required|min:8|unique:listas,nombre',
            'descripcion' => 'required|min:10|max:255',
            'imagen' => 'nullable|image',
        ]);

        DB::beginTransaction();

        $img = '';

        try {
            //Imagen
            if ($request->hasFile('imagen')) {
                $img = $request->file('imagen')->store('miniaturas', 'public');
            }

            //crear el slug
            $slug = Str::slug($request->nombre, '-');

            Lista::create([
                'nombre' => $request->nombre,
                'slug' => $slug,
                'descripcion' => $request->descripcion,
                'portada' => 'no',
                'disponible' => 'no',
                'miniatura' => $img,
                'user_id' => \auth()->id(),
            ]);

            DB::commit();

            return \redirect()
                ->route('admin.listas.index')
                ->with([
                    'flash.banner' => 'La lista se ha creado con éxito',
                    'flash.bannerStyle' => 'success'
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function edit(Lista $lista)
    {
        //
        $this->authorize('update', $lista);
        return \view('admin.listas.edit', \compact('lista'));

    }


    public function update(Request $request, Lista $lista)
    {
        $this->authorize('update', $lista);

        //variable no utilizada
        $request->noImage = false;

        //
        $request->validate([
            'nombre' => 'required|min:8|unique:listas,nombre,' . $lista->id,
            'descripcion' => 'required|min:10|max:255',
            'imagen' => 'nullable|image',
        ]);

        DB::beginTransaction();

        try {
            //Variables a utilizar
            $disponible = 'no';
            if ($request->disponible == 'si') {
                $disponible = 'si';
            }

            $portada = 'no';
            if ($request->portada == 'si') {
                $portada = 'si';
            }

            //Verificar que no exista una entrada como portada
            if ($portada == 'si') {
                $filtro = Lista::where('portada', 'si')->where('id', '!=', $lista->id)->get()->first();
                if ($filtro) {
                    $filtro->portada = 'no';
                    $filtro->save();
                }
            }

            //Almacenar la imagen
            $img = $lista->miniatura;

            // Verificar si se desea la imagen
            if ($request->noImage != true) {
                if ($request->hasFile('imagen')) {
                    $img = $request->file('imagen')->store('miniaturas', 'public');
                    //Validar la imagen anterior
                    if ($lista->miniatura != '') {
                        \unlink(\public_path($lista->imagen));
                    }
                }
            } else {
                //Validar que exista un video
                $img = '';
                //Validar la imagen anterior
                if ($lista->miniatura != '') {
                    //Eliminar usando el accesor
                    \unlink(\public_path($lista->imagen));
                }
            }
            //Verificar que no exista una entrada como portada
            if ($portada == 'si') {
                $filtro = Lista::where('portada', 'si')->where('id', '!=', $lista->id)->get()->first();
                if ($filtro) {
                    $filtro->portada = 'no';
                    $filtro->save();
                }
            }

            //crear el slug
            $slug = Str::slug($request->nombre, '-');

            //Guardar la lista
            $lista->update([
                'nombre' => $request->nombre,
                'slug' => $slug,
                'descripcion' => $request->descripcion,
                'portada' => $portada,
                'disponible' => $disponible,
                'miniatura' => $img,
            ]);

            $lista->videos()->sync($request->videos);

            DB::commit();

            return \redirect()
                ->route('admin.listas.index')
                ->with([
                    'flash.banner' => 'La lista se ha actualizado con éxito',
                    'flash.bannerStyle' => 'success'
                ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function destroy(Lista $lista)
    {
        //Verificar permisos
        $this->authorize('delete', $lista);

        //Eliminar la imagen si existe
        if ($lista->miniatura != '') {
            \unlink(\public_path($lista->imagen));
        }

        $lista->delete();

        return \redirect()
            ->route('admin.listas.index')
            ->with([
                'flash.banner' => 'La lista se ha eliminado con éxito',
                'flash.bannerStyle' => 'success'
            ]);
    }
}
