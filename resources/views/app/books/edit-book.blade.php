@extends('layouts.base')

@section('title', 'Editar Livro')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Editar Livro</h1>
        <form action="{{ route('books.update', $livro->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block font-medium">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $livro->title) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="genre" class="block font-medium">Gênero</label>
                <input type="text" name="genre" id="genre" value="{{ old('genre', $livro->genre) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="isbn" class="block font-medium">ISBN</label>
                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $livro->isbn) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="publication_date" class="block font-medium">Data de Publicação</label>
                <input type="date" name="publication_date" id="publication_date" value="{{ old('publication_date', $livro->publication_date) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">Descrição</label>
                <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $livro->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="cover_image" class="block font-medium">Nova Capa (opcional)</label>
                <input type="file" name="cover_image" id="cover_image" class="w-full border rounded px-3 py-2">
                @if($livro->cover_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $livro->cover_image) }}" alt="Capa atual" class="w-32 h-40 object-cover rounded shadow">
                    </div>
                @endif
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Salvar Alterações</button>
        </form>
    </div>
@endsection
