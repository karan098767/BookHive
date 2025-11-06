@extends('layouts.app')

@section('title','Add Author')

@section('content')
<h1 class="text-xl font-bold mb-4">Add Author</h1>

<form method="POST" action="{{ route('authors.store') }}">
  @csrf
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div>
      <label class="block text-sm">First Name</label>
      <input name="first_name" class="w-full border p-2 rounded" />
      {{-- @error('title') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror --}}
    </div>

    <div>
      <label class="block text-sm">Last Name</label>
      <input name="last_name" class="w-full border p-2 rounded" />
      {{-- @error('author_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror --}}
    </div>

  <div class="mt-4">
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
    <a href="{{ route('authors.index') }}" class="ml-2 text-sm text-gray-600">Cancel</a>
  </div>
</form>
@endsection
