@extends('layouts.app')

@section('title','Edit Book')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Book</h1>

<form method="POST" action="{{ route('books.update', $book) }}">
  @csrf @method('PUT')
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div>
      <label class="block text-sm">Title</label>
      <input name="title" value="{{ old('title', $book->title) }}" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Author</label>
      <select name="author_id" class="w-full border p-2 rounded">
        @foreach($authors as $a)
          <option value="{{ $a->id }}" @if($a->id == $book->author_id) selected @endif>{{ $a->first_name }} {{ $a->last_name }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="block text-sm">ISBN</label>
      <input name="isbn" value="{{ old('isbn', $book->isbn) }}" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Genre</label>
      <input name="genre" value="{{ old('genre', $book->genre) }}" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Published Date</label>
      <input type="date" name="published_date" value="{{ optional($book->published_date)->format('Y-m-d') }}" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Copies</label>
      <input type="number" min="0" name="copies" value="{{ old('copies', $book->copies) }}" class="w-full border p-2 rounded" />
    </div>

    <div class="md:col-span-2">
      <label class="block text-sm">PDF Link (optional)</label>
      <input name="pdf_link" value="{{ old('pdf_link', $book->pdf_link) }}" class="w-full border p-2 rounded" />
    </div>
  </div>

  <div class="mt-4">
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
    <a href="{{ route('books.index') }}" class="ml-2 text-sm text-gray-600">Cancel</a>
  </div>
</form>
@endsection
