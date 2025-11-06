@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Member</h2>

    <form method="POST" action="{{ route('members.update', $member->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" value="{{ $member->first_name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" value="{{ $member->last_name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ $member->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone_number" value="{{ $member->phone_number }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" value="{{ $member->dob }}" class="form-control">
        </div>

        <button class="btn btn-success">Update Member</button>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
