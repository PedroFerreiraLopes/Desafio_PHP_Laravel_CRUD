<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('dashboard', compact('usuarios'));
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        // Auth::guard('web')->logout();
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(LoginRequest $request): RedirectResponse
    {
        // dd($request);
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('/', absolute: false));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ddd = "(" . substr($request->telefone, 0, 2) . ")";
        if (strlen($request->telefone) == 10) {
            $telefone_formatado = $ddd . substr($request->telefone, 2, 4) . "-" . substr($request->telefone, 6, 4);
        }
        else {
            $telefone_formatado = $ddd . substr($request->telefone, 2, 5) . "-" . substr($request->telefone, 7);
        }

        $request['telefone'] = $telefone_formatado;

        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'data_nascimento' => ['required', 'date'],
            'cpf' => ['required', 'cpf'],
            'telefone' => ['required', 'celular_com_ddd'],
            'genero' => 'required|in:Masculino,Feminino,Não Declarado',
            'senha' => ['required', 'confirmed'],
        ]);

        $usuario = Usuario::create($request->all());

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(route('/', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request, Usuario $usuario): RedirectResponse
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'data_nascimento' => ['required', 'date'],
            'cpf' => ['required', 'cpf'],
            'telefone' => ['required', 'celular_com_ddd'],
            'genero' => 'required|in:Masculino,Feminino,Não Declarado',
            'senha' => ['required', 'confirmed'],
        ]);

        $usuario->update($request->all());

        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        if (auth()->id() === $usuario->id) {
            $usuario->delete();
            return redirect()->route('landing')->with('success', 'Conta excluída com sucesso!');
        }
    
        return redirect()->route('landing')->with('error', 'Você não tem permissão para excluir esta conta.');
    }
}
