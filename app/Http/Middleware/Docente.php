<?php
namespace App\Http\Middleware;

use App\Model\TUsuario;

use App\Helpers\Rol;

use Session;
use Closure;

class Docente
{
    public function handle($request, Closure $next)
    {
        if(Session::has('usuario'))
        {
            $roles_check = '';

            foreach (Session::get('usuario')->user_roles as $role)
            {
                $roles_check = $roles_check == '' ? $role->rol->name : $roles_check .','. $role->rol->name;
            }

            $roles = explode(',', $roles_check);

            if(in_array('Administrador', $roles) || in_array('Docente', $roles))
            {
                if(Session::get('usuario')->state == "Activo")
                {
                    return $next($request);
                }
                else
                {
                    Session::flash('error','Su cuenta de usuario no está activo comuniquese con el administrador.');
                    Session::forget('usuario');
                    return redirect('/');
                }
            }

            abort(401);
        }

        Session::forget('usuario');
        return redirect('/');
    }
}