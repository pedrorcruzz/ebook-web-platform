@extends('layouts.base')

@section('title', 'Meu Livro')

@section('content')
    <div class="container mx-auto px-4" style="min-height: 90vh;">
        <h1 class="text-2xl font-bold mb-4 mt-24">
            @auth
                Seja bem vindo, {{ Auth::user()->username }}
            @else
                    Seja bem vindo, visitante
            @endauth
        </h1>
        <div class="flex justify-center mt-8">
            <form method="GET" action="{{ route('app.index') }}" class="w-full max-w-md flex">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Pesquisar livros..."
                    class="flex-1 p-2 border border-gray-300 rounded-l-md"
                >
                <button type="submit" class="bg-indigo-600 text-white px-4 rounded-r-md hover:bg-indigo-700">Buscar</button>
            </form>
        </div>
        <div class="grid grid-cols-1 mt-14 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($livros as $livro)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ $livro->cover_image ? asset('storage/' . $livro->cover_image) : 'https://via.placeholder.com/150' }}" alt="{{ $livro->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $livro->title }}</h2>
                        <p class="text-gray-600">{{ $livro->description }}</p>
                        <a href="{{ route('app.books.details', ['id' => $livro->id]) }}" class="text-blue-500 hover:underline mt-2 block">Colocar no Carrinho</a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500">Nenhum livro encontrado.</div>
            @endforelse
        </div>
    </div>
@endsection
