<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromedioMateria extends Model
{
    protected $table      = 'promedio_materia';
    protected $primaryKey = 'id';

    public $timestamps = true;

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id', 'id');
    }
}