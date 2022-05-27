<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Models\User;

use Auth;
use DB;
use Session;

class UsuarioController extends Controller
{
    public function usuario()
    {
        return view('web.usuario');
    }

    public function login(Request $request)
    {
        $user = User::with(['user_roles.rol', 'alumno', 'docente.tipogrado'])->where('email', $request->get('email'))->first();

        if($user)
        {
            if(Hash::check($request->get('password'), $user->password))
            {
                Session::put('usuario', $user);

                return redirect('home');
            }

            Session::flash('error-login', 'La contraseña es incorrecta');

            return redirect('/');
        }

        Session::flash('error-login', 'El correo electrónico no existe');

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Session::flush();

        return redirect('/');
    }

    public function recoveryPass(Request $request)
    {

        return view('admin/recoverypass');
    }

    public function sendCodeRecoveryPass(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if($user)
        {
            $code_recuperation = time() .'-'. $user->id;

            $user->code_recuperation = $code_recuperation;

            $user->save();
            
            Mail::send('admin.email', ['code_recuperation' => $code_recuperation], function($msj) use($user){

                $msj->from(ENV('MAIL_USERNAME'),"Sistema Académico FAE SGA");
                $msj->subject('Código de recuperación');
                $msj->to($user->email);
            });

            Session::flash('success', 'Se envió un mensaje con un código de recuperación a su correo');

            return redirect('user/recoveryPass');
        }

        Session::flash('error', 'El correo electrónico no existe');

        return redirect('user/recoveryPass');
    }

    public function formRecuperationPass(Request $request)
    {
        return view('admin/coderecovery');
    }

    public function codeValidationPass(Request $request)
    {
        $user = User::where('code_recuperation', $request->get('code_recuperation'))->first();

        if($user)
        {
            if($request->get('new_password') == $request->get('confirmation_password'))
            {
                $user->password          = Hash::make($request->get('new_password'));
                $user->code_recuperation = null;

                $user->save();

                Session::flash('success', 'Su contraseña fue actualizada correctamente');

                return redirect('user/form/coderecuperation');
            }
            
            Session::flash('error', 'La nueva contraseña y el confirmar no coinciden');

            return redirect('user/form/coderecuperation');
        }

        Session::flash('error', 'El código no existe');

        return redirect('user/form/coderecuperation');
    }
}