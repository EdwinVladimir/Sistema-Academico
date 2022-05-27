<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;

use DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $lista_user = User::with(['alumno', 'docente', 'user_roles.rol'])
                            ->where('dni', 'like', '%'. $request->get('data') .'%')
                            ->orWhere('name', 'like', '%'. $request->get('data') .'%')
                            ->orWhere('email', 'like', '%'. $request->get('data') .'%')
                            ->orderby('name', 'asc')
                            ->get();

        $list_role = Role::orderBy('name', 'asc')->get();

        return response(['lista_user' => $lista_user, 'lista_role' => $list_role]);
    }

    public function createUsuario(Request $request)
    {
        $this->validate($request,
            [
                'dni' => 'required|unique:users',
                'name'   => 'required',
                'lastname'   => 'required',
                'email' => 'required|unique:users',
                'rol'   => 'required',
                'state' => 'required',
            ],
            [
                'dni.required' => 'El campo ya existe',
                'dni.unique' => 'El DNI ya existe',

                'lastname.required' => 'El campo es requerido',

                'name.required' => 'El campo es requerido',

                'email.required' => 'El campo es requerido',
                'email.unique' => 'El email ya existe',

                'rol.required' => 'Seleccione uno o muchos roles',

                'state.required' => 'Seleccione un estado',
            ]
        );

        try
        {
            DB::beginTransaction();

            $user = new User();

            $user->dni      = $request->get('dni');
            $user->name     = $request->get('name');
            $user->lastname = $request->get('lastname');
            $user->email    = $request->get('email');
            $user->password = Hash::make($request->get('email'));
            $user->state    = $request->get('state');

            $user->save();

            $user = User::all()->last();

            $lista_roles = explode(',', $request->get('rol'));

            for($i = 0; $i < count($lista_roles); $i++)
            {
                $role = Role::find($lista_roles[$i]);

                if($role->name == 'Docente')
                {
                    $docente = new Docente();

                    $docente->id_user = $user->id;
                    $docente->dni_doc = $request->get('dni');
                    $docente->nom_doc = $request->get('name');
                    $docente->ape_doc = $request->get('lastname');

                    $docente->save();
                }
                elseif($role->name == 'Estudiante')
                {
                    $alumno = new Alumno();

                    $alumno->id_user = $user->id;
                    $alumno->dni_al  = $request->get('dni');
                    $alumno->nom_al  = $request->get('name');
                    $alumno->ape_al  = $request->get('lastname');

                    $alumno->save();
                }

                $role_user = new RoleUser();

                $role_user->id_rol  = $lista_roles[$i];
                $role_user->id_user = $user->id;

                $role_user->save();
            }

            DB::commit();

            return response()->json(['estado_accion' => true], 200);
        }
        catch(Exception $e)
        {
            DB::rollback();

            return response()->json(['estado_accion' => false], 400);
        }
    }

    public function updateUsuario(Request $request, $id)
    {
        $this->validate($request,
            [
                'dni' => 'required|unique:users,dni,'. $id,
                'name'   => 'required',
                'email' => 'required|unique:users,email,'. $id,
                'rol'   => 'required',
                'state' => 'required',
            ],
            [
                'dni.unique' => 'El DNI ya existe',

                'lastname.required' => 'El campo es requerido',

                'name.required' => 'El campo es requerido',

                'email.required' => 'El campo es requerido',
                'email.unique' => 'El email ya existe',

                'rol.required' => 'Seleccione uno o muchos roles',

                'state.required' => 'Seleccione un estado',
            ]
        );

        try
        {
            DB::beginTransaction();

            //actuliza datos de usuario
            $user = User::with(['alumno', 'docente', 'user_roles'])->find($id);

            $user->dni      = $request->get('dni');
            $user->name     = $request->get('name');
            $user->lastname = $request->get('lastname');
            $user->email    = $request->get('email');
            $user->state    = $request->get('state');

            $user->save();

            //eliminar roles asignados al crear usuario
            foreach ($user->user_roles as $role)
            {
                $role_user = RoleUser::find($role->id);

                $role_user->delete();
            }

            //asignar los nuevos roles a actualizar
            $lista_roles = explode(',', $request->get('rol'));

            for($i = 0; $i < count($lista_roles); $i++)
            {
                $role = Role::find($lista_roles[$i]);

                if($role->name == 'Docente')
                {
                    if(count($user->docente) > 0)
                    {
                        $docente = Docente::find($user->docente[0]->id);

                        $docente->dni_doc = $request->get('dni');
                        $docente->nom_doc = $request->get('name');
                        $docente->ape_doc = $request->get('lastname');

                        $docente->save();
                    }
                    else
                    {
                        $docente = new Docente();

                        $docente->id_user = $user->id;
                        $docente->dni_doc = $request->get('dni');
                        $docente->nom_doc = $request->get('name');
                        $docente->ape_doc = $request->get('lastname');

                        $docente->save();
                    }
                }
                elseif($role->name == 'Estudiante')
                {
                    if(count($user->alumno) > 0)
                    {
                        $alumno = Alumno::find($user->alumno[0]->id);

                        $alumno->dni_al = $request->get('dni');
                        $alumno->nom_al = $request->get('name');
                        $alumno->ape_al = $request->get('lastname');

                        $alumno->save();
                    }
                    else
                    {
                        $alumno = new Alumno();

                        $alumno->id_user = $user->id;
                        $alumno->dni_al  = $request->get('dni');
                        $alumno->nom_al  = $request->get('name');
                        $alumno->ape_al  = $request->get('lastname');

                        $alumno->save();
                    }
                }

                $role_user = new RoleUser();

                $role_user->id_rol  = $lista_roles[$i];
                $role_user->id_user = $user->id;

                $role_user->save();
            }

            DB::commit();

            return response()->json(['estado_accion' => true], 200);
        }
        catch(Exception $e)
        {
            DB::rollback();

            return response()->json(['estado_accion' => false], 400);
        }
    }

    public function mostrar($id)
    {
        $user = User::with('user_roles')->find($id);

        return response()->json(['user' => $user]);
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json(['estado_accion' => true], 200);
    }

    public function resetearPassword($id)
    {
        $user = User::find($id);

        $user->password = Hash::make($user->email);

        $user->save();
        
        return response()->json(['estado_accion' => true], 200);
    }

    public function cambiarPassword(Request $request)
    {
        $user = User::where('email', $request->get('email'))
                    ->where('dni', $request->get('dni'))
                    ->first();

        if($user)
        {
            if(Hash::check($request->get('now_password'), $user->password))
            {
                $user->password = Hash::make($request->get('new_password'));

                $user->save();

                return response()->json(['estado_accion' => true], 200);
            }

            return response()->json(['estado_accion' => false], 200);
        }

        return response()->json(['estado_accion' => 'dniInvalido'], 200);
    }
}
