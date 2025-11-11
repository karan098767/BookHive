@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Library Members</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('members.create') }}" class="btn btn-primary mb-3">Add New Member</a>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>Books Borrowed</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->phone_number ?? 'N/A' }}</td>
                <td>{{ $member->dob ?? 'N/A' }}</td>
                <td>{{ $member->total_books_borrowed }}</td>
                <td>
                    @if($member->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this member?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
