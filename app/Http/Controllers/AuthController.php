<?php

namespace App\Http\Controllers;

use App\Models\UserAuthor;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login()
    {
        return view('app.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/profile')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Email ou senha incorreta.',
        ]);
    }

    public function register()
    {
        return view('app.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_author',
            'password' => 'required|string|min:8|confirmed',
            'description' => 'nullable|string',
        ], [
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'password.confirmed' => 'A senhas não conferem.',
        ]);

        $user = UserAuthor::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'description' => $request->description,
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect('/profile')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout realizado com sucesso!');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('app.auth.manager-author', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:user_author,username,' . $user->id,
            'email' => 'required|email|unique:user_author,email,' . $user->id,
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ], [
            'username.unique' => 'Este nome de usuário já está em uso.',
            'email.unique' => 'Este email já está em uso.',
            'new_password.min' => 'A nova senha deve ter pelo menos :min caracteres.',
            'new_password.confirmed' => 'As senhas não conferem.',
        ]);

        try {
            $data = [
                'username' => $request->username,
                'email' => $request->email,
                'description' => $request->description
            ];

            if ($request->filled('current_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
                }
                $data['password'] = Hash::make($request->new_password);
            }

            if ($request->hasFile('profile_picture')) {
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $data['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
            }

            UserAuthor::where('id', $user->id)->update($data);

            return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erro ao atualizar perfil. Por favor, tente novamente.']);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'password' => 'required',
            ]);

            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors(['password' => 'Senha incorreta.']);
            }

            Book::where('user_author_id', $user->id)->delete();

            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $userId = $user->id;

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            UserAuthor::where('id', $userId)->delete();

            return redirect('/')->with('success', 'Sua conta foi excluída com sucesso.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erro ao excluir conta. Por favor, tente novamente.']);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('app.author.profile', compact('user'));
    }
}
