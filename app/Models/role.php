<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table      = 'roles';
    protected $primaryKey = 'id';

    use HasFactory;

    protected $fillable = ['id','name','guard_name'];

    public function role_roles()
    {
        return $this->hasMany('App\Models\RoleUser', 'id_rol', 'id');
    }
}