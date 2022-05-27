<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangoPromedio extends Model
{
    protected $table      = 'rango_promedio';
    protected $primaryKey = 'id';

    public $timestamps = true;
    /*protected $fillable = ['id','name','guard_name'];

    public function role_roles()
    {
        return $this->hasMany('App\Models\RoleUser', 'id_rol', 'id');
    }*/
}