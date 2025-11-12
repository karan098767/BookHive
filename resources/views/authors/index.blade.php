@extends('layouts.app')

@section('title','Authors')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold">Authors</h1>
  <div class="flex space-x-2">
    <form method="GET" action="{{ route('authors.index') }}" class="flex">
      <input name="name" type="text" value="{{ request('name') }}" class="px-3 py-2 border rounded-l" />
      <button class="px-3 py-2 bg-indigo-600 text-white rounded-r">Search</button>
    </form>
    <a href="{{ route('authors.create') }}" class="px-3 py-2 bg-green-600 text-white rounded">Add Author</a>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  @foreach($authors as $at)
    <div class="bg-white p-4 rounded shadow">
      <div class="flex justify-between">
        <h2 class="font-semibold">{{ $at->first_name }} {{ $at->last_name }}</h2>
        <span class="text-xs px-2 py-1 bg-gray-100 rounded">{{ $at->id }}</span>
      </div>
      <p class="text-sm text-gray-600 mt-1">Total Books: {{ $bookCount[$at->id] ?? 0 }}</p>
      <div class="mt-3 flex items-center justify-between">
        <a href="{{ route('authors.show', $at) }}" class="text-indigo-600 text-sm">View</a>
        <div class="space-x-2">
          <a href="{{ route('authors.edit', $at) }}" class="text-sm text-yellow-600">Edit</a>
          <form action="{{ route('authors.destroy', $at) }}" method="POST" class="inline" onsubmit="return confirm('Delete author?')">
            @csrf @method('DELETE')
            <button class="text-red-600 text-sm">Delete</button>
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-6">
  {{ $authors->links() }}
</div>
@endsection