<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Filters
        if ($request->filled('search')) {
            $query->Where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('genre', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('isbn', 'LIKE', '%' . $request->search . '%');
        }

        $books=$query->paginate(15);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();

        // load template with book form
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // submit form submission into book table
        $books = Book::create($request->all());

        // once complete, reroute to index page
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        // show books with specifc id
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        $authors = Author::all();

        // sends you to the template with pre-filled books that can be edited
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Book::findOrFail($id);

        // grabs updated values from edit form
        $books->update($request->all());

        // once complete, reroute to index page
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Book::findOrFail($id);

        //
        $books->delete();

        // once complete, reroute to index page
        return redirect()->route('books.index')
        ->with('success', 'Book deleted successfully.');
    }
}
