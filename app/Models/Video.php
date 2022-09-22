<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    //Devolver valores creados con el accesor
    protected $appends = ['fecha', 'autor', 'foto_user', 'id_listas', 'imagen', 'abstract'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'miniatura',
        'portada',
        'disponible',
        'plataforma_id',
        'canal_id',
        'user_id',
        'url',
        'iframe',
    ];

    //Regresar el slug del video
    #No se usa slug solo el id

    public function canal() {
        return $this->belongsTo(Canal::class);
    }
    
    public function plataforma() {
        return $this->belongsTo(Plataforma::class);
    }

    public function etiquetas() {
        return $this->belongsToMany(Etiqueta::class);
    }

    public function listas() {
        return $this->belongsToMany(Lista::class);
    }

    //Recuperar imagen vacia
    public function imagen() :Attribute
    {
        return new Attribute(
            get: function() {
                if($this->miniatura == '') {
                    //Si no existe imagen
                    return Storage::url('no-img.jpg');
                } else {
                    //Regresar la imagen almacenada
                    return Storage::url($this->miniatura);
                }
            },
        );
    }

    //Crear la fecha facil de entender
    public function fecha() :Attribute
    {
        return new Attribute(
            get: function() {
                return Carbon::parse($this->created_at)->diffForHumans();
            }
        );
    }

    //Regresar el autor del video
    public function autor() :Attribute
    {
        return new Attribute(
            get: function() {
                return $this->canal->user->name;
            }
        );
    }

    //Regresar el autor del video
    public function fotoUser() :Attribute
    {
        return new Attribute(
            get: function() {
                return $this->canal->user->profile_photo_url;
            }
        );
    }

    //regresar los id de las listas asociadas
    public function idListas() :Attribute
    {
        return new Attribute(
            get: function() {
                //Obtener todas la lista relacionada
                $all = $this->listas()->get();
                //Iniciar un array vacio
                $lista = [];
                //recorrer la lista
                if ($all->count()) {
                    foreach ($all as $item) {
                        $lista[] = $item->id;
                    }
                } else {
                    $lista = [];
                }

                return $lista;
            }
        );
    }

    //Limitar los caracteres de la descripcion
    public function abstract() :Attribute
    {
        return new Attribute(
            get: function() {
                return Str::limit($this->descripcion, 180, '...');
            }
        );
    }

    
}
