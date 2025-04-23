@extends('layouts.base')

@section('title', 'Cadastrar Livro')

@section('content')
    <div class="flex justify-center items-center min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4 text-center">Cadastrar Livro</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('books.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="genre" class="block text-sm font-medium text-gray-700">Gênero</label>
                    <select name="genre" id="genre" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Selecione um gênero</option>
                        <option value="Ficção">Ficção</option>
                        <option value="Programação">Programação</option>
                        <option value="Romance">Romance</option>
                        <option value="Mistério">Mistério</option>
                        <option value="Fantasia">Fantasia</option>
                        <option value="Terror">Terror</option>
                        <option value="Suspense">Suspense</option>
                        <option value="Ação">Ação</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                    <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" required maxlength="13"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="publication_date" class="block text-sm font-medium text-gray-700">Data de Publicação</label>
                    <input type="date" name="publication_date" id="publication_date"
                        value="{{ old('publication_date') }}" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea name="description" id="description"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="cover_image" class="block text-sm font-medium text-gray-700">Capa do Livro</label>
                    <input type="file" name="cover_image" id="cover_image" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-medium
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100">
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cadastrar Livro
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
