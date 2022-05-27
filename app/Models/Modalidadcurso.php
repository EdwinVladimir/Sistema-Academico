<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidadcurso extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','nom_moda','desc_moda'];
}
