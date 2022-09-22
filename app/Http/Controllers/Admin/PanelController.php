<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Canal;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    //
    public function __invoke()
    {
        $this->authorize('dashboard', User::class);

        if (Auth::user()->canal == null) {
            //Si no tiene canal crear un canal
            Canal::create([
                'clave' => \uniqid(),
                'descripcion' => 'Hola este es mi canal',
                'user_id' => \auth()->id(),
            ]);
        }
        
        return \view('admin.dashboard');
    }
}
