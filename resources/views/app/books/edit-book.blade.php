@extends('layouts.base')

@section('title', 'Editar Livro')

@section('content')
    <div class="container mx-auto px-4 py-8 mt-14">
        <h1 class="text-2xl font-bold mb-6 text-indigo-600">Editar Livro</h1>
        <form action="{{ route('books.update', $livro->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block font-medium">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $livro->title) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="genre" class="block font-medium">Gênero</label>
                <input type="text" name="genre" id="genre" value="{{ old('genre', $livro->genre) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="isbn" class="block font-medium">ISBN</label>
                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $livro->isbn) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="pages" class="block font-medium">Quantidade de Páginas</label>
                <input type="number" name="pages" id="pages" min="1" value="{{ old('pages', $livro->pages) }}"
                    class="w-full border rounded px-3 py-2" placeholder="Ex: 200">
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium">Preço (R$)</label>
                <input type="text" name="price" id="price"
                    value="{{ old('price', number_format($livro->price, 2, ',', '.')) }}"
                    class="w-full border rounded px-3 py-2" placeholder="Ex: 00,00">
            </div>

            <div class="mb-4">
                <label for="publication_date" class="block font-medium">Data de Publicação</label>
                <input type="date" name="publication_date" id="publication_date"
                    value="{{ old('publication_date', $livro->publication_date) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">Descrição</label>
                <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $livro->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="cover_image" class="block font-medium">Nova Capa (opcional)</label>
                <input type="file" name="cover_image" id="cover_image" class="w-full border rounded px-3 py-2">
                @if ($livro->cover_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $livro->cover_image) }}" alt="Capa atual"
                            class="w-32 h-40 object-cover rounded shadow">
                    </div>
                @endif
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-400">Salvar
                Alterações</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.getElementById('price');
            priceInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');

                value = value.replace(/^0+/, '');
                if (value.length < 3) {
                    value = value.padStart(3, '0');
                }

                let cents = value.slice(-2);
                let reais = value.slice(0, -2);

                reais = reais.replace(/^0+/, '') || '0';

                reais = reais.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                e.target.value = reais + ',' + cents;
            });

            if (priceInput.value) {
                let value = priceInput.value.replace(/\D/g, '');
                value = value.replace(/^0+/, '');
                if (value.length < 3) {
                    value = value.padStart(3, '0');
                }
                let cents = value.slice(-2);
                let reais = value.slice(0, -2);
                reais = reais.replace(/^0+/, '') || '0';
                reais = reais.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                priceInput.value = reais + ',' + cents;
            }
        });
    </script>
@endsection
