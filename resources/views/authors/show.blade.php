@extends('layouts.app')

@section('title', 'View Author')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h1 class="text-2xl font-bold">{{ $authors->first_name }} {{ $authors->last_name }}</h1>
  <p class="text-gray-600">Total Books: {{ $bookCount[$authors->id] ?? 0 }}</p>
  <p class="mt-2">Books:</p>
  <ul class="list-disc">
    @foreach ($book as $bk)
      <li><a href='/books/{{ $bk->id }}' class='text-blue-600 hover:text-blue-900' target="_blank">{{ $bk->title }}</a> - {{ $bk->genre }}</li>
    @endforeach
  </ul>

  {{-- <p class="mt-2">Genre: {{ $book->genre }}</p>
  <p>ISBN: {{ $book->isbn }}</p>
  <p>Copies: {{ $book->copies }}</p>
  <p>Status: {{ ucfirst($book->status) }}</p> --}}

  {{-- @if($book->pdf_link)
    <a href="{{ $book->pdf_link }}" class="inline-block mt-4 px-3 py-2 bg-blue-600 text-white rounded">Download PDF</a>
  @endif --}}
</div>
@endsection