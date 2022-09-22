<?php

namespace App\Http\Livewire\Admin\Panel;

use App\Models\Video;
use App\Models\Vista;
use Carbon\Carbon;
use Livewire\Component;

class Panel extends Component
{
    public $labelGlobal, $dataGlobal;
    public $labelAcceso, $dataAcceso;

    protected $listeners = ['get_accesos', 'get_global'];

    public function mount()
    {
        $this->emit('datosGAccess', $this->graficaAcceso());
    }

    public function render()
    {
        //Ultimo video
        $last = Video::orderBy('created_at', 'desc')
                        ->where('canal_id', \auth()->user()->canal->id)
                        ->get()
                        ->first() ?? [];

        $videosMas = Video::orderBy('vistas', 'desc')
                        ->where('canal_id', \auth()->user()->canal->id)
                        ->get()
                        ->take(7) ?? [];
        
        $videosMenos = Video::orderBy('vistas', 'asc')
                        ->where('canal_id', \auth()->user()->canal->id)
                        ->get()
                        ->take(7) ?? [];


        return view('livewire.admin.panel.panel', \compact('last', 'videosMas', 'videosMenos'));
    }

    //Devolver los valores a la grafica
    private function graficaAcceso()
    {
        //Iniciar los datos
        $vistas = Vista::orderBy('created_at', 'desc')->get()->take(5);
        $dataAccesos = [];

        foreach ($vistas as $key => $vista) {
            //Cargar los datos de la grafica
            $dataAccesos['labels'][] = Carbon::parse($vista->created_at)->format('d-M-Y');
            $dataAccesos['data'][] = $vista->vistas;
        }

        //regresar los datos
        return $dataAccesos;
    }

    //Devolver los valores a la grafica
    private function graficaGlobal()
    {
        //Iniciar los datos
        $grafica = [
            'data' => [],
            'labels' => [],
        ];

        $videos = Video::all();

        //Recuperar los videos de los ultimos 7 dias
        if ($videos->count() > 0) {

            //Obtener la lista para recuperar los valores por fecha
            $lista = Video::orderBy('updated_at', 'desc')
                ->where('canal_id', \auth()->user()->canal->id)
                ->get();

            //Recorrer los campos de fechas
            $labels = $lista->groupBy(function ($date) {
                return Carbon::parse($date->updated_at)->format('d-m-Y');
            })->take(7); #Usar solo 7 grupos 

            //Recorrer los grupos para obtener los datos
            foreach ($labels as $key => $datos) {
                //Usar la clave del array (fechas) para los labels
                $grafica['labels'][] = $key;
                //Contador de vistas
                $vistas = 0;
                //recorrer cada grupo
                foreach ($datos as $video) {
                    //Aumentar el contador en el anterior mas las vistas de cada elemento
                    $vistas = $vistas + $video->vistas;
                }

                //Agregar las vistas al array
                $grafica['data'][] = $vistas;
            }


        }

        //regresar los datoss
        return $grafica;
    }

    public function get_accesos() {
        $this->emit('datos-acceso', $this->graficaAcceso());
    }

    public function get_global() {
        $this->emit('datos-global', $this->graficaGlobal());
    }
}
