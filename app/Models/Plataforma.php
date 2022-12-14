<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function videos()
    {
        return $this->belongsTo(Video::class);
    }
}
