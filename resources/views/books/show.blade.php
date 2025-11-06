@extends('layouts.app')

@section('title',$book->title)

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h1 class="text-2xl font-bold">{{ $book->title }}</h1>
  <p class="text-gray-600">By {{ $book->author->first_name }} {{ $book->author->last_name }}</p>
  <p class="mt-2">Genre: {{ $book->genre }}</p>
  <p>ISBN: {{ $book->isbn }}</p>
  <p>Copies: {{ $book->copies }}</p>
  <p>Status: {{ ucfirst($book->status) }}</p>
  <p>Total times borrowed: {{ $book->total_borrow_count }}</p>

  @if($book->pdf_link)
    <a href="{{ $book->pdf_link }}" class="inline-block mt-4 px-3 py-2 bg-blue-600 text-white rounded">Download PDF</a>
  @endif
</div>
@endsection
