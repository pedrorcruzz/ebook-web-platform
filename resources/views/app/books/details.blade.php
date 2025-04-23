@extends('layouts.base')

@section('title', $livro->title)

@section('content')
    <div class="container mx-auto px-4" style="min-height: 90vh;">
        <div class="flex flex-col md:flex-row mt-24 gap-8">
            <div class="md:w-1/2 flex justify-center items-start">
                @if ($livro->cover_image)
                    <img src="{{ asset('storage/' . $livro->cover_image) }}" alt="Capa do livro {{ $livro->title }}"
                        class="w-full max-w-md max-h-[480px] object-cover rounded-lg shadow-lg mx-auto">
                @else
                    <img src="https://via.placeholder.com/400x480" alt="Imagem não disponível"
                        class="w-full max-w-md max-h-[480px] object-cover rounded-lg shadow-lg mx-auto">
                @endif
            </div>
            <div class="md:w-1/2 md:pl-8 flex flex-col">
                <h1 class="text-4xl font-bold mb-4 text-indigo-600">{{ $livro->title }}</h1>

                <div class="mb-6">
                    <p class="text-gray-600 text-base mb-2">Autor: {{ $livro->author->username }}</p>
                    <p class="text-gray-600 text-base mb-2">Gênero: {{ $livro->genre }}</p>
                    <p class="text-gray-600 text-base mb-2">ISBN: {{ $livro->isbn }}</p>
                    <p class="text-gray-600 text-base mb-2">
                        Páginas: <span class="font-semibold">{{ $livro->pages ?? 'N/A' }}</span>
                    </p>
                    <p class="text-gray-600 text-base mb-2">
                        Preço: <span class="font-semibold text-indigo-600">
                            R$ {{ number_format($livro->price, 2, ',', '.') }}
                        </span>
                    </p>
                    <p class="text-gray-600 text-base mb-2">Data de Publicação:
                        {{ \Carbon\Carbon::parse($livro->publication_date)->format('d/m/Y') }}</p>
                </div>

                <div class="bg-gray-100 p-4 rounded-lg mb-6">
                    <h2 class="text-xl font-semibold mb-2 text-indigo-600">Descrição</h2>
                    <div class="text-gray-700 text-base max-h-48 md:max-h-60 overflow-y-auto pr-2"
                        style="white-space: pre-line;">
                        {{ $livro->description ?? 'Nenhuma descrição disponível.' }}
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600 mb-2">Status:
                        <span
                            class="font-semibold {{ $livro->status === 'available' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $livro->status === 'available' ? 'Disponível' : 'Indisponível' }}
                        </span>
                    </p>
                </div>

                <div class="flex justify-center">
                    @if ($livro->status === 'available')
                        <button
                            class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-400 transition duration-300 flex items-center mb-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                            Adicionar ao Carrinho
                        </button>
                    @else
                        <button
                            class="bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed mb-2 flex items-center"
                            disabled>
                            Indisponível
                        </button>
                    @endif
                </div>

                <!-- <div class="mt-8"> -->
                <!--     <a href="{{ route('app.index') }}" class="text-indigo-400 hover:underline flex items-center"> -->
                <!--         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" -->
                <!--             fill="currentColor"> -->
                <!--             <path fill-rule="evenodd" -->
                <!--                 d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" -->
                <!--                 clip-rule="evenodd" /> -->
                <!--         </svg> -->
                <!--         Voltar para a lista de livros -->
                <!--     </a> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
@endsection}
