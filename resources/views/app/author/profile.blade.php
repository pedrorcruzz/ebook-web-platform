@extends('layouts.base')

@section('title', 'Perfil do Autor')

@section('content')
    <div class="flex flex-col min-h-screen bg-gray-100 pt-16">
        <div class="flex flex-row flex-grow">
            <div class="w-1/4 bg-white shadow-md">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-4">Menu</h2>
                    <ul>
                        <li class="mb-2">
                            <a href="{{route ('app.author.register-book')}}" class="bg-blue-500 text-white font-bold text-lg inline-block hover:bg-blue-600 rounded px-4 py-2">
                                Adicionar Livro
                            </a>
                        </li>
                        <li class="mb-2"><a href="{{route ('app.author.manage-book')}}" class="text-blue-500 hover:underline">Meus Livros</a></li>
                        <li class="mb-2"><a href="#" class="text-blue-500 hover:underline">Assinaturas</a></li>
                        <li class="mb-2"><a href="{{route ('app.author.manage-author')}}" class="text-blue-500 hover:underline">Configurações</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex-grow p-8">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="flex flex-col items-center">
                        <div class="mb-4">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Foto de Perfil" class="w-24 h-24 rounded-full shadow-md object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}&background=4F46E5&color=fff&size=96" alt="Foto de Perfil" class="w-24 h-24 rounded-full shadow-md object-cover">
                            @endif
                        </div>
                        <h1 class="text-2xl font-bold mb-4 text-center">{{ Auth::user()->username }}</h1>
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700">Email: {{ Auth::user()->email }}</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700">
                                Biografia: {{ Auth::user()->description ?? 'Nenhuma biografia cadastrada.' }}
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700">
                                Status:
                                @if(Auth::user()->status === 'active')
                                    <span class="text-green-600 font-semibold">Ativo</span>
                                @else
                                    <span class="text-red-600 font-semibold">Inativo</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
