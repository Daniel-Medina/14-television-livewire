<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lista extends Model
{
    use HasFactory;

    //Incluir los accesores al json
    protected $appends = ['imagen', 'videos_count', 'foto_user', 'fecha'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'miniatura',
        'portada',
        'disponible',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    //Accesores
    public function imagen(): Attribute
    {
        //DEvolver la imagen con enlace
        return new Attribute(
            get: function () {
                if ($this->miniatura != '') {
                    return Storage::url($this->miniatura);
                } else if ($this->videos->count() != 0) {
                    return $this->videos[0]->imagen;
                } else {
                    return Storage::url('no-img.jpg');
                }
            }
        );
    }

    public function videosCount(): Attribute
    {
        //Devolver la cantidad de videos de la lista
        return new Attribute(
            get: function () {
                return $this->videos->count() == 0 ? 'Sin videos' : $this->videos->count();
            }
        );
    }

    public function fotoUser() :Attribute
    {
        //Devolder la imagen del usuario
        return new Attribute(
            get: function() {
                return $this->user->profile_photo_url;
            }
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
}
