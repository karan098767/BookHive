@extends('layouts.app')

@section('title','Books')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold">Books</h1>
  <div class="flex space-x-2">
    <form method="GET" action="{{ route('books.index') }}" class="flex">
      <input name="q" value="{{ $q ?? '' }}" placeholder="Search title, genre, isbn" class="px-3 py-2 border rounded-l" />
      <button class="px-3 py-2 bg-indigo-600 text-white rounded-r">Search</button>
    </form>
    <a href="{{ route('books.create') }}" class="px-3 py-2 bg-green-600 text-white rounded">Add Book</a>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  @foreach($books as $book)
    <div class="bg-white p-4 rounded shadow">
      <div class="flex justify-between">
        <h2 class="font-semibold">{{ $book->title }}</h2>
        <span class="text-xs px-2 py-1 bg-gray-100 rounded">{{ $book->genre }}</span>
      </div>
      <p class="text-sm text-gray-600 mt-1">By: {{ $book->author->first_name }} {{ $book->author->last_name }}</p>
      <p class="text-sm text-gray-600">ISBN: {{ $book->isbn }}</p>
      <div class="mt-3 flex items-center justify-between">
        <a href="{{ route('books.show', $book) }}" class="text-indigo-600 text-sm">View</a>
        <div class="space-x-2">
          <a href="{{ route('books.edit', $book) }}" class="text-sm text-yellow-600">Edit</a>
          <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Delete book?')">
            @csrf @method('DELETE')
            <button class="text-red-600 text-sm">Delete</button>
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-6">
  {{ $books->links() }}
</div>
@endsection
