<?php

namespace App\Http\Livewire\Home\Videos;

use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        if ($this->search != '') {
            $videos = Video::orderBy('nombre', 'asc')
                            ->where('disponible', 'si')
                            ->where('nombre', 'LIKE' , '%'. $this->search . '%')
                            ->paginate(3);
        } else {
            $videos = Video::orderBy('nombre', 'asc')
                            ->where('disponible', 'si')
                            ->paginate(3);
        }
        

        return view('livewire.home.videos.search', \compact('videos'))
             ->layout('layouts.app', ['nombre' => 'Buscar videos']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
