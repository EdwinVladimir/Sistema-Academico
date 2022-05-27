<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuxPromedioCurso extends Model
{
    protected $table      = 'aux_promedio_curso';
    protected $primaryKey = 'id';

    public $timestamps = false;
    /*protected $fillable = ['id','name','guard_name'];

    public function role_roles()
    {
        return $this->hasMany('App\Models\RoleUser', 'id_rol', 'id');
    }*/
}