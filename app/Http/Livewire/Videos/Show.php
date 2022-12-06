<?php

namespace App\Http\Livewire\Videos;

use App\Models\Comentario;
use App\Models\Video;
use Livewire\Component;

class Show extends Component
{
    public $video;
    public $mensaje;

    protected $listeners = ['destroy'];

    public function mount($video)
    {
        $this->video = $video;
    }

    public function render()
    {
        $comentarios = Comentario::orderBy('id', 'desc')->where('video_id', $this->video->id)->get();

        return view('livewire.videos.show', \compact('comentarios'));
    }

    public function resetUI() {
        $this->resetErrorBag();
        $this->mensaje = '';
    }

    public function store()
    {
        $rules = [
            'mensaje' => 'required'
        ];

        $this->validate($rules);

        $this->video->comentarios()->create([
            'mensaje' => $this->mensaje,
            'user_id' => \auth()->id()
        ]);

        $this->video = Video::find($this->video->id);
        $this->render();
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();

        $this->video = Video::find($this->video->id);
        $this->render();
    }
}
