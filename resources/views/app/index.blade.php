@extends('layouts.base')

@section('title', 'Meu Livro')

@section('content')
    <div class="w-full bg-[#f7fcfd] py-16">
        <div class="container mx-auto bg-gray-200 flex flex-col md:flex-row items-center justify-between px-4 mt-6">
            <div class="md:w-1/2 mb-12 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight text-gray-900">
                    Compre e venda seus <br>
                    <span class="text-gray-900">ebooks pelo melhor <span class="text-indigo-600">preço</span>.</span>
                </h1>
                <p class="text-lg text-gray-500 mb-8">
                    Descubra os melhores preços para comprar e vender livros digitais no Meu Livro. Negocie com confiança e
                    facilidade!
                </p>
                <div class="flex items-center gap-4">
                    <a href="#"
                        class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-400 text-white font-semibold px-7 py-3 rounded-full shadow transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Buscar Livro
                    </a>
                    <a href="#" class="flex items-center gap-2 text-gray-700 font-semibold">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mr-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <polygon points="5,3 19,10 5,17 5,3" />
                            </svg>
                        </span>
                        Como funciona
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('images/hero-bg.png') }}" alt="Livros e pessoas lendo"
                    class="max-w-full rounded-3xl shadow-lg" style="min-width:320px; max-width:480px;">
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                    @auth
                        Olá, <span class="text-indigo-600">{{ Auth::user()->username }}</span> 👋
                    @else
                        Seja bem vindo ao <span class="text-indigo-600">Meu Livro</span>!
                    @endauth
                </h2>
                <p class="text-gray-500 text-base">
                    Encontre, compre e venda seus ebooks favoritos com facilidade e segurança.
                </p>
            </div>
        </div>

        <form method="GET" action="{{ route('app.index') }}" class="flex flex-col md:flex-row items-center gap-4 mb-12">
            <div class="relative flex-1 w-full">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Pesquisar livros e ISBN..."
                    class="w-full py-3 pl-12 pr-4 rounded-full border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 transition text-gray-700 shadow-sm">
                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
            </div>
            <div class="relative w-full md:w-56">
                <select name="genre"
                    class="appearance-none w-full py-3 pl-4 pr-10 rounded-full border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 transition text-gray-700 shadow-sm">
                    <option value="">Todos os Gêneros</option>
                    @php
                        $uniqueGenres = $livros->pluck('genre')->unique()->filter()->values();
                    @endphp
                    @foreach ($uniqueGenres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                            {{ $genre }}
                        </option>
                    @endforeach
                </select>
                <span
                    class="pointer-events-none absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 flex items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </div>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-full shadow transition">
                Buscar
            </button>
        </form>

        @php
            use Illuminate\Support\Str;
        @endphp

        <div class="grid grid-cols-1 mt-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($livros as $livro)
                <div class="bg-white shadow-md rounded-xl overflow-hidden transition hover:shadow-lg flex flex-col h-full">
                    <img src="{{ $livro->cover_image ? asset('storage/' . $livro->cover_image) : 'https://via.placeholder.com/150' }}"
                        alt="{{ $livro->title }}" class="w-full h-48 object-cover">
                    <div class="flex flex-col flex-1 justify-between p-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-1">{{ $livro->title }}</h2>
                            <p class="text-indigo-600 font-bold text-base mb-1">
                                R$ {{ number_format($livro->price, 2, ',', '.') }}
                            </p>
                            <p class="text-gray-600 text-sm mb-2">
                                {{ Str::limit($livro->description, 260, '...') }}
                            </p>
                        </div>
                        <div class="mt-4 flex flex-col gap-2">
                            @if ($livro->genre)
                                <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full">
                                    {{ $livro->genre }}
                                </span>
                            @endif
                            @if ($livro->author->username)
                                <span class="inline-block bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full">
                                    Autor:
                                    {{ $livro->author->username }}
                                </span>
                            @endif
                            <a href="{{ route('app.books.details', ['id' => $livro->id]) }}"
                                class="text-indigo-600 hover:underline font-semibold">Ver detalhes</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500">Nenhum livro encontrado.</div>
            @endforelse
        </div>
    </div>
@endsection
