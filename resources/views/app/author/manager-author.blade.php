@extends('layouts.base')

@section('title', 'Gerenciar Perfil')

@section('content')
    <div class="flex flex-col min-h-screen bg-gray-100 pt-16">
        <div class="flex flex-row flex-grow">
            <div class="w-1/4 bg-white shadow-md">
                <div class="p-4">
                    <nt-bold mb-4">Menu<rder rounded-lg focus:outline-none focus:ring-2">
                </div>
                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">
                    Excluir Conta
                </button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection/h2>
<ul>
    <li class="mb-2">
        <a href="{{ route('app.author.profile') }}" class="text-indigo-400 hover:underline">
            Voltar ao Perfil
        </a>
    </li>
</ul>
</div>
</div>
<div class="flex-grow p-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-6 text-indigo-600">Editar Perfil</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('auth.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Nome de Usuário
                </label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Biografia
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2">{{ old('description', $user->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="profile_picture">
                    Nova Foto de Perfil
                </label>
                <div class="flex items-center space-x-4">
                    <div class="w-24 h-24">
                        @if ($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto de Perfil Atual"
                                class="w-24 h-24 rounded-full shadow-md object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=4F46E5&color=fff&size=96"
                                alt="Foto de Perfil Atual" class="w-24 h-24 rounded-full shadow-md object-cover">
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file" name="profile_picture" id="profile_picture"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <h3 class="text-lg font-bold mb-4">Alterar Senha</h3>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="current_password">
                    Senha Atual
                </label>
                <input type="password" name="current_password" id="current_password"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password">
                    Nova Senha
                </label>
                <input type="password" name="new_password" id="new_password"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password_confirmation">
                    Confirmar Nova Senha
                </label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-400">
                    Salvar Alterações
                </button>
            </div>
        </form>

        <hr class="my-8">

        <div class="mt-8">
            <h3 class="text-lg font-bold text-red-600 mb-4">Excluir Conta</h3>
            <p class="text-gray-600 mb-4">
                Atenção: Esta ação não pode ser desfeita. Todos os seus dados serão permanentemente excluídos.
            </p>
            <form action="{{ route('auth.destroy') }}" method="POST"
                onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
                @csrf
                @method('DELETE')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Digite sua senha para confirmar
                    </label>
                    <input type="password" name="password" id="password" required class="w-full px-3 py-2 boh2 class="
                        text-xl fo
