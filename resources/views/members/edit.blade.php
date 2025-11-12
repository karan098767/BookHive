@extends('layouts.app')

@section('title','Edit Member')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Member</h1>

<form method="POST" action="{{ route('members.update',$member) }}">
  @csrf @method('PUT')
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div>
      <label class="block text-sm">First Name</label>
      <input name="first_name" value="{{ old('first_name',$member->first_name) }}" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Last Name</label>
      <input name="last_name" value="{{ old('last_name',$member->last_name) }}" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Phone Number</label>
      <input name="phone_number" value="{{ old('phone_number',$member->phone_number) }}" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Email</label>
      <input type="email" name="email" value="{{ old('email',$member->email) }}" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">New Password (optional)</label>
      <input type="password" name="password" class="w-full border p-2 rounded" />
    </div>

    <div>
      <label class="block text-sm">Date of Birth</label>
      <input type="date" name="dob" value="{{ old('dob',$member->dob) }}" class="w-full border p-2 rounded" />
    </div>
  </div>

  <div class="mt-4">
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
    <a href="{{ route('members.index') }}" class="ml-2 text-sm text-gray-600">Cancel</a>
  </div>
</form>
@endsection
