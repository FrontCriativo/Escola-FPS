<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class TCCController extends Controller
{
    public function index()
    {
        if (! Schema::hasTable('books')) {
            return view('tcc.index', ['booksPayload' => []]);
        }

        $books = Book::query()
            ->with('category')
            ->where('is_featured', true)
            ->orderBy('title')
            ->get();

        if ($books->isEmpty()) {
            $books = Book::query()
                ->with('category')
                ->orderBy('title')
                ->limit(8)
                ->get();
        }

        return view('tcc.index', [
            'booksPayload' => $this->bookPayload($books),
        ]);
    }

    public function todos()
    {
        return view('tcc.todos', [
            'books' => Schema::hasTable('books')
                ? Book::query()->with('category')->orderBy('title')->get()
                : collect(),
        ]);
    }

    private function bookPayload(Collection $books): array
    {
        return $books->map(fn (Book $book): array => [
            'title' => $book->title,
            'author' => $book->author,
            'genre' => $book->category?->name ?? 'Geral',
            'emoji' => '??',
            'image' => $book->cover_path,
            'color' => $book->accent_color,
            'available' => $book->is_available,
            'rating' => '?????',
            'desc' => $book->description,
            'year' => $book->publication_year,
            'pages' => $book->pages,
            'modalDescription' => $book->description,
        ])->values()->all();
    }
}
