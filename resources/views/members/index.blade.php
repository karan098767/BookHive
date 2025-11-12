@extends('layouts.app')

@section('title','Members')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold">Members</h1>
  <a href="{{ route('members.create') }}" class="px-3 py-2 bg-green-600 text-white rounded">Add Member</a>
</div>

<table class="min-w-full bg-white border rounded shadow">
  <thead>
    <tr class="bg-gray-100 text-left">
      <th class="p-2">#</th>
      <th class="p-2">Name</th>
      <th class="p-2">Email</th>
      <th class="p-2">Books Borrowed</th>
      <th class="p-2">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($members as $m)
    <tr class="border-t">
      <td class="p-2">{{ $m->id }}</td>
      <td class="p-2">{{ $m->first_name }} {{ $m->last_name }}</td>
      <td class="p-2">{{ $m->email }}</td>
      <td class="p-2">{{ $m->borrowings()->count() }}</td>
      <td class="p-2 flex space-x-2">
        <a href="{{ route('members.show',$m) }}" class="text-indigo-600 text-sm">View</a>
        <a href="{{ route('members.edit',$m) }}" class="text-yellow-600 text-sm">Edit</a>
        <form action="{{ route('members.destroy',$m) }}" method="POST" onsubmit="return confirm('Delete member?')">
          @csrf @method('DELETE')
          <button class="text-red-600 text-sm">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-4">
  {{ $members->links() }}
</div>
@endsection
