<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    public function create()
    {
        return view('app.author.register-book');
    }

    public function store(Request $request)
    {
        $price = $request->price;
        $price = str_replace(['.', ','], ['', '.'], $price);
        $request->merge(['price' => $price]);

        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'isbn' => 'required|string|size:13|unique:book',
            'pages' => 'nullable|integer',
            'price' => 'required|numeric',
            'publication_date' => 'required|date',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('book-covers', 'public');
        }

        Book::create([
            'user_author_id' => Auth::id(),
            'title' => $request->title,
            'genre' => $request->genre,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'price' => $request->price,
            'publication_date' => $request->publication_date,
            'description' => $request->description,
            'cover_image' => $coverImagePath,
            'status' => 'available',
        ]);

        return redirect()->route('app.author.profile')->with('success', 'Livro cadastrado com sucesso!');
    }

    public function details($id)
    {
        $livro = Book::with('author')
            ->findOrFail($id);

        return view('app.books.details', compact('livro'));
    }

    public function manage()
    {
        $livros = Book::where('user_author_id', Auth::id())->get();
        return view('app.author.manager-book', compact('livros'));
    }

    public function edit($id)
    {
        $livro = Book::where('user_author_id', Auth::id())
            ->findOrFail($id);
        return view('app.books.edit-book', compact('livro'));
    }

    public function update(Request $request, $id)
    {
        $livro = Book::where('user_author_id', Auth::id())
            ->findOrFail($id);

        $price = $request->price;
        $price = str_replace(['.', ','], ['', '.'], $price);
        $request->merge(['price' => $price]);

        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'isbn' => 'required|string|size:13|unique:book,isbn,' . $id,
            'pages' => 'nullable|integer',
            'price' => 'required|numeric',
            'publication_date' => 'required|date',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('book-covers', 'public');
        }

        $livro->update($data);

        return redirect()->route('app.author.manage-book')
            ->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $livro = Book::where('user_author_id', Auth::id())
            ->findOrFail($id);

        $livro->delete();

        return redirect()->route('app.author.manage-book')
            ->with('success', 'Livro excluído com sucesso!');
    }
}
