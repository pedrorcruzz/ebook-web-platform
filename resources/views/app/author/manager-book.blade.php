@extends('layouts.base')

@section('title', 'Gerenciar Livros')

@section('content')
    <div class="flex flex-col min-h-screen bg-gray-100 pt-16">
        <div class="flex flex-row flex-grow">
            <div class="w-1/4 bg-white shadow-md">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-4">Menu</h2>
                    <ul>
                        <li class="mb-2">
                            <a href="{{ route('app.author.register-book') }}"
                                class="bg-indigo-600 text-white font-bold text-lg inline-block hover:bg-indigo-400 rounded px-4 py-2">
                                Adicionar Livro
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('app.author.profile') }}" class="text-indigo-400 hover:underline">Voltar ao
                                Perfil</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex-grow p-8">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="text-2xl font-bold mb-6 text-indigo-600">Meus Livros</h2>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-6">
                        @forelse($livros as $livro)
                            <div class="border rounded-lg p-4 flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $livro->cover_image ? asset('storage/' . $livro->cover_image) : 'https://via.placeholder.com/150' }}"
                                        alt="{{ $livro->title }}" class="w-20 h-20 object-cover rounded">
                                    <div>
                                        <h3 class="font-bold text-lg">{{ $livro->title }}</h3>
                                        <p class="text-gray-600">Gênero: {{ $livro->genre }}</p>
                                        <p class="text-gray-600">ISBN: {{ $livro->isbn }}</p>
                                        <p class="text-sm text-gray-500">Publicado em:
                                            {{ \Carbon\Carbon::parse($livro->publication_date)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('books.edit', $livro->id) }}"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-400">
                                        Editar
                                    </a>
                                    <form action="{{ route('books.destroy', $livro->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                            onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500">
                                Você ainda não cadastrou nenhum livro.
                                <a href="{{ route('app.author.register-book') }}" class="text-indigo-400 hover:underline">
                                    Cadastre seu primeiro livro aqui!
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
