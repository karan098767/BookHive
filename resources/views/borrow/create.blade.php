@extends('layouts.app')

@section('title','Issue Book')

@section('content')
<h1 class="text-xl font-bold mb-4">Issue Book</h1>

<form method="POST" action="{{ route('borrow.store') }}">
  @csrf
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div>
      <label class="block text-sm">Book</label>
      <select name="book_id" class="w-full border p-2 rounded">
        @foreach($books as $b)
          <option value="{{ $b->id }}">{{ $b->title }} ({{ $b->copies }} copies left)</option>
        @endforeach
      </select>
      @error('book_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm">Member</label>
      <select name="member_id" class="w-full border p-2 rounded">
        @foreach($members as $m)
          <option value="{{ $m->id }}">{{ $m->first_name }} {{ $m->last_name }}</option>
        @endforeach
      </select>
      @error('member_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm">Issue Date</label>
      <input type="date" name="issue_date" class="w-full border p-2 rounded" value="{{ old('issue_date', date('Y-m-d')) }}" />
    </div>

    <div>
      <label class="block text-sm">Due Date</label>
      <input type="date" name="due_date" class="w-full border p-2 rounded" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}" />
    </div>
  </div>

  <div class="mt-4">
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Issue</button>
    <a href="{{ route('borrow.index') }}" class="ml-2 text-sm text-gray-600">Cancel</a>
  </div>
</form>
@endsection
