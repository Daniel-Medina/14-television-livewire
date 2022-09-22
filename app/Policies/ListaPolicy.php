<?php

namespace App\Policies;

use App\Models\Lista;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListaPolicy
{
    use HandlesAuthorization;

    public function access(User $user)
    {
        //Acceder como admin
        return $user->rol === 'ADMIN';
    }


    public function view(User $user, Lista $lista)
    {
        //Proteger ocultos (No admin)
        return $lista->disponible === 'si';

    }


    public function create(User $user)
    {
        //Crear una lista
        return $user->rol === 'ADMIN';
    }

    public function update(User $user, Lista $lista)
    {
        //Editar una lista propia

        if ($user->rol === 'ADMIN' && $lista->user->id === $user->id ) {
            return true;
        } else {
            return false;
        }
    }


    public function delete(User $user, Lista $lista)
    {
        //Eliminar una lista propia

        if ($user->rol === 'ADMIN' && $lista->user->id === $user->id ) {
            return true;
        } else {
            return false;
        }
    }


}
