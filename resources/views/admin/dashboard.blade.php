@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  <div class="bg-white p-4 rounded shadow">
    <div class="text-sm text-gray-500">Books</div>
    <div class="text-2xl font-bold">{{ $booksCount }}</div>
  </div>

  <div class="bg-white p-4 rounded shadow">
    <div class="text-sm text-gray-500">Members</div>
    <div class="text-2xl font-bold">{{ $membersCount }}</div>
  </div>

  <div class="bg-white p-4 rounded shadow">
    <div class="text-sm text-gray-500">Currently Borrowed</div>
    <div class="text-2xl font-bold">{{ $activeBorrows }}</div>
  </div>
</div>

<div class="mt-6">
  <h2 class="font-semibold">Recent Activity</h2>
  <div class="mt-3 bg-white p-4 rounded shadow">
    @foreach($recentActivities as $r)
      <div class="border-b py-2">
        <div class="text-sm">
          <strong>{{ $r->member->first_name ?? 'Member' }}</strong>
          borrowed
          <em>{{ $r->book->title ?? 'Book' }}</em>
          on {{ optional($r->issue_date)->format('Y-m-d') }}
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
