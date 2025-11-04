@extends('layouts.app')

@section('title','Admin Login')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
  <h1 class="text-xl font-bold mb-4">Admin Login</h1>

  @if($errors->any())
    <div class="text-red-600 mb-3">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <div>
      <label class="block text-sm">Email</label>
      <input name="email" value="{{ old('email','admin@example.com') }}" class="w-full border p-2 rounded" />
    </div>

    <div class="mt-3">
      <label class="block text-sm">Password</label>
      <input type="password" name="password" class="w-full border p-2 rounded" />
    </div>

    <div class="mt-4 flex items-center justify-between">
      <button class="px-4 py-2 bg-indigo-600 text-white rounded">Login</button>
      <a href="{{ route('books.index') }}" class="text-sm text-gray-600">Back</a>
    </div>
  </form>
</div>
@endsection
