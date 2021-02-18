<?php

namespace Serbinario\Http\Controllers\Auth;

use Serbinario\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->{$this->username()},
            'password' => $request->password,
        ];
    }

    public function authenticated(Request $request, $user)
    {
        //[RF007-RN001]
        if (!$user->is_active) {
            auth()->logout();
            return back()->with('error_message', 'Seu login está desativado');
        }

        //[RF004-RN002
        if (!$user->franquia->is_active) {
            auth()->logout();
            return back()->with('error_message', 'Sua franquia está desativada');
        }

        if ( $user->hasRole('revenda') ) {// do your magic here
            return redirect()->route('orcamento.index');
        }

        //dd($user->getAllPermissions());
        if (count($user->getAllPermissions()) == 0) {
            auth()->logout();
           return back()->with('error_message', 'O ADM da franquia falta definir grupos de permissões');
        }

        if ($user->hasPermissionTo('read.cliente')) {
            return redirect()->route('cliente.cliente.index');
        }

        if ($user->hasPermissionTo('read.cliente')) {
            return redirect()->route('cliente.cliente.index');
        }

        if ($user->hasPermissionTo('read.os.instalacao')) {
            return redirect()->route('visita_tecnica.index');
        }

        if ( $user->hasRole('advocacia') ) {// do your magic here
            return redirect()->route('documento.index');
        }
        return redirect()->intended($this->redirectPath());
    }
}
