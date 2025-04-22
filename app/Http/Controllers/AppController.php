<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'ILIKE', "%{$search}%")
                ->orWhere('isbn', 'ILIKE', "%{$search}%")
                ->orWhere('genre', 'ILIKE', "%{$search}%");
        }

        $livros = $query->get();

        return view('app.index', compact('livros'));
    }
}
