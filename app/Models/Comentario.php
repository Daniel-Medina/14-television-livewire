<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $appends = ['foto_user', 'fecha', 'autor'];

    protected $guarded = ['id'];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fotoUser() :Attribute
    {
        return new Attribute(
            get: function() {
                return $this->user->profile_photo_url;
            },
        );
    }
    
    public function autor() :Attribute
    {
        return new Attribute(
            get: function() {
                return $this->user->name;
            },
        );
    }

    public function fecha() :Attribute
    {
        return new Attribute(
            get: function() {
                return Carbon::parse($this->created_at)->diffForHumans();
            },
        );
    }
}
