<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Author::query();

        // Filters
        if ($request->filled('name')) {
            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", '%' . $request->name . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->name . '%');
        }

        $authors=$query->paginate(15);

        // Total book count

        // $bookCount = Author::select('authors.id')
        //                     ->addSelect(DB::raw('COUNT(books.id) AS book_count'))
        //                     ->leftJoin('books', 'authors.id', '=', 'books.author_id')
        //                     ->groupBy('authors.id')
        //                     ->pluck('book_count', 'id');

        $bookCount = Author::withCount('books')->pluck('books_count', 'id');

        return view('authors.index', compact('authors', 'bookCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // load template with author form
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // submit form submission into author table
        $authors = Author::create($request->all());

        // once complete, reroute to index page
        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $authors = Author::findOrFail($id);
        // show authors with specifc id

        // display all of their books
        $book = Book::select('title', 'genre', 'id')
                ->where('author_id', $id)
                ->get();

        //
        $bookCount = Author::withCount('books')->pluck('books_count', 'id');
        return view('authors.show', compact('authors', 'book', 'bookCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $authors = Author::findOrFail($id);
        // sends you to the template with pre-filled authors that can be edited
        return view('authors.edit', compact('authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $authors = Author::findOrFail($id);

        // grabs updated values from edit form
        $authors->update($request->all());

        // once complete, reroute to index page
        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $authors = Author::findOrFail($id);

        //
        $authors->delete();

        // once complete, reroute to index page
        return redirect()->route('authors.index')
        ->with('success', 'Author deleted successfully.');
    }
}
