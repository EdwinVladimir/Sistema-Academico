<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    use HasRoles;
    use HasFactory, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'rol',
        'state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_roles()
    {
        return $this->hasMany('App\Models\RoleUser', 'id_user', 'id');
    }

    public function alumno()
    {
        return $this->hasMany('App\Models\Alumno', 'id_user', 'id');
    }

    public function docente()
    {
        return $this->hasMany('App\Models\Docente', 'id_user', 'id');
    }
}
