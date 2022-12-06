<?php

namespace App\Http\Livewire\Admin\Pruebas;

use App\Models\Config;
use App\Models\Lista;
use App\Models\Video;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Developers extends Component
{
    public $modal = true;

    public $config;

    public function mount()
    {
        $this->config = Config::find(1);
    }

    public function render()
    {
        return view('livewire.admin.pruebas.developers');
    }

    public function generarSlug($bool)
    {
        DB::beginTransaction();

        if ($bool) {
            try {
                $this->config->urls_amigables = true;
                $this->config->save();

                //generar los slugs de las listas
                $videos = Video::all();

                //Generar slugs videos
                foreach ($videos as $key => $video) {
                    //validar si existe un slug
                    if ($video->slug == null) {
                        $video->slug = Str::slug($video->nombre);
                        $video->save();
                    }
                }

                //Generar slugs listas
                $listas = Lista::all();
                foreach ($listas as $lista) {
                    if ($lista->slug == null) {
                        $lista->slug = Str::slug($lista->nombre);
                        $lista->save();
                    }
                }

                //Guardar los datos
                DB::commit();
            } catch (\Throwable $th) {
                //Revertir cambios
                DB::rollBack();
                echo ($th);
            }
        } else {
            //desactivar las opciones
            $this->config->urls_amigables = false;
            $this->config->save();
            DB::commit();
        }
    }

    public function permitirComentarios($bool)
    {
        if ($bool) {
            //Permitir
            $this->config->comentarios = true;
        } else {
            //Denegar
            $this->config->comentarios = false;
        }
        
        $this->config->save();
    }
}
