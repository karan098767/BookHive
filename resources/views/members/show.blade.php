@extends('layouts.app')

@section('title','Member Details')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <h1 class="text-xl font-bold">{{ $member->first_name }} {{ $member->last_name }}</h1>
  <p class="text-gray-600">Email: {{ $member->email }}</p>
  <p class="text-gray-600">Phone: {{ $member->phone_number }}</p>
  <p class="text-gray-600">Books Borrowed: {{ $member->borrowings()->count() }}</p>


  <h2 class="mt-4 font-semibold text-gray-700">Borrow History</h2>
  <ul class="mt-2 list-disc pl-5">
    @forelse($member->borrowings as $b)
      <li>{{ $b->book->title ?? 'Book deleted' }} — issued {{ $b->issue_date->format('Y-m-d') }} 
        @if($b->date_returned)
          (Returned {{ $b->date_returned->format('Y-m-d') }})
        @else
          <span class="text-red-600">(Not yet returned)</span>
        @endif
      </li>
    @empty
      <li>No records yet.</li>
    @endforelse
  </ul>
</div>
@endsection
