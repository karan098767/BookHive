@extends('layouts.app')

@section('title','Update Borrow Record')

@section('content')
<h1 class="text-xl font-bold mb-4">Update Borrow Record</h1>

<form method="POST" action="{{ route('borrow.update',$borrow) }}">
  @csrf @method('PUT')
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div>
      <label class="block text-sm">Book</label>
      <input disabled value="{{ $borrow->book->title ?? 'N/A' }}" class="w-full border p-2 rounded bg-gray-100" />
    </div>
    <div>
      <label class="block text-sm">Member</label>
      <input disabled value="{{ $borrow->member->first_name ?? 'N/A' }}" class="w-full border p-2 rounded bg-gray-100" />
    </div>
    <div>
      <label class="block text-sm">Issue Date</label>
      <input disabled value="{{ $borrow->issue_date->format('Y-m-d') }}" class="w-full border p-2 rounded bg-gray-100" />
    </div>
    <div>
      <label class="block text-sm">Due Date</label>
      <input disabled value="{{ $borrow->due_date->format('Y-m-d') }}" class="w-full border p-2 rounded bg-gray-100" />
    </div>
    <div>
      <label class="block text-sm">Date Returned</label>
      <input type="date" name="date_returned" value="{{ optional($borrow->date_returned)->format('Y-m-d') }}" class="w-full border p-2 rounded" />
    </div>
  </div>

  <div class="mt-4">
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
    <a href="{{ route('borrow.index') }}" class="ml-2 text-sm text-gray-600">Cancel</a>
  </div>
</form>
@endsection
