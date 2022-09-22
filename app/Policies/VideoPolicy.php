<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function access(User $user)
    {
        //Acceder como administrador
        return $user->rol === 'ADMIN';
    }

    public function view(Video $video)
    {
        //Ver los archivos ocultos
        return $video->disponible == 'si';
    }

    public function create(User $user)
    {
        //Crear un recurso
        return $user->rol === 'ADMIN';
    }

    public function update(User $user, Video $video)
    {
        //
        if ($user->rol !== 'ADMIN') {
            return false;
        }

        if ($video->canal->user->id == $user->id) {
            return true;
        } 

        return false;
    }

    public function delete(User $user, Video $video)
    {
        //
        if ($user->rol !== 'ADMIN') {
            return false;
        }
        
        if ($video->canal->user->id == $user->id) {
            return true;
        } 

        return false;
    }

}
