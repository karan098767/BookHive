@extends('layouts.app')

@section('title','Add Member')

@section('content')
<h1 class="text-xl font-bold mb-4">Add Member</h1>

<form method="POST" action="{{ route('members.store') }}">
  @csrf
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div>
      <label class="block text-sm">First Name</label>
      <input name="first_name" class="w-full border p-2 rounded" />
      @error('first_name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm">Last Name</label>
      <input name="last_name" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Phone Number</label>
      <input name="phone_number" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Email</label>
      <input type="email" name="email" class="w-full border p-2 rounded" />
      @error('email')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm">Password</label>
      <input type="password" name="password" class="w-full border p-2 rounded" />
      @error('password')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm">Date of Birth</label>
      <input type="date" name="dob" class="w-full border p-2 rounded" />
    </div>
  </div>

  <div class="mt-4">
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
    <a href="{{ route('members.index') }}" class="ml-2 text-sm text-gray-600">Cancel</a>
  </div>
</form>
@endsection
