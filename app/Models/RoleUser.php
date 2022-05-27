<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table      = 'role_user';
    protected $primaryKey = 'id';

    public $timestamps   = true;
    public $incrementing = true;

    public function rol()
    {
        return $this->belongsTo('App\Models\Role', 'id_rol');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}