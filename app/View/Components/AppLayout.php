<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $nombre = '';

    public function __construct($nombre = '')
    {
        //
        $this->nombre = $nombre;
    }
    
    public function render()
    {
        return view('layouts.app');
    }
}
