@extends('layouts.app')

@section('title','Borrow Records')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold">Borrow Records</h1>
  <a href="{{ route('borrow.create') }}" class="px-3 py-2 bg-green-600 text-white rounded">Issue Book</a>
</div>

<table class="min-w-full bg-white border rounded shadow text-sm">
  <thead class="bg-gray-100">
    <tr>
      <th class="p-2">Book</th>
      <th class="p-2">Member</th>
      <th class="p-2">Issue Date</th>
      <th class="p-2">Due Date</th>
      <th class="p-2">Returned</th>
      <th class="p-2">Late Fee</th>
      <th class="p-2">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($records as $r)
    <tr class="border-t">
      <td class="p-2">{{ $r->book->title ?? 'N/A' }}</td>
      <td class="p-2">{{ $r->member->first_name ?? 'N/A' }}</td>
      <td class="p-2">
  {{ \Carbon\Carbon::parse($r->due_date)->format('Y-m-d') }}
</td>
<td class="p-2">
  {{ $r->date_returned ? \Carbon\Carbon::parse($r->date_returned)->format('Y-m-d') : '-' }}
</td>

      <td class="p-2">{{ $r->date_returned ? $r->date_returned->format('Y-m-d') : '-' }}</td>
      <td class="p-2">
  {{ $r->late_fee ? number_format($r->late_fee, 0) . ' KES' : '-' }}
</td>

      <td class="p-2 flex space-x-2">
        <a href="{{ route('borrow.edit',$r) }}" class="text-yellow-600 text-sm">Update</a>
        <form method="POST" action="{{ route('borrow.destroy',$r) }}" onsubmit="return confirm('Delete record?')">
          @csrf @method('DELETE')
          <button class="text-red-600 text-sm">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-4">
  {{ $records->links() }}
</div>
@endsection
