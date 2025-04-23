@extends('layouts.base')

@section('title', 'Cadastro')

@section('content')
    <div class="flex justify-center items-center min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4 text-center text-indigo-600 mt-32">Cadastro</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.store') }}"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-10" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Nome de Usuário</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required
                        placeholder="Seu nome de usuário"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-3 text-base">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        placeholder="Seu email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-3 text-base">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" name="password" id="password" required placeholder="Sua senha aqui"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-3 text-base">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirme a
                        Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        placeholder="Confirme sua senha"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-3 text-base">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Biografia</label>
                    <textarea name="description" id="description" placeholder="Uma breve descrição sobre você"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-3 text-base"
                        rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-medium
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100">
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cadastrar
                    </button>
                </div>
            </form>

            <div class="text-center  p-4">
                <a href="{{ route('auth.login') }}" class="text-base text-indigo-600 hover:text-indigo-500">
                    Já tem uma conta? Faça login
                </a>
            </div>
        </div>
    </div>
@endsection
