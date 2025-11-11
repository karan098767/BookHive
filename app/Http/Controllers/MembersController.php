<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    // Display a list of members
    public function index()
    {
        // For now, just pass a sample array
        $members = [
            ['name' => 'Alice', 'email' => 'alice@example.com'],
            ['name' => 'Bob', 'email' => 'bob@example.com'],
        ];

        return view('members.index', compact('members'));
    }

    // Show form to create a new member
    public function create()
    {
        return view('members.create');
    }

    // Store a new member
    public function store(Request $request)
    {
        // Normally you'd validate and save to DB
        // $request->validate([...]);
        // Member::create($request->all());

        return redirect()->route('members.index')
                         ->with('success', 'Member added successfully!');
    }

    // Show a single member
    public function show($id)
    {
        // Placeholder
        $member = ['name' => 'Alice', 'email' => 'alice@example.com'];

        return view('members.show', compact('member'));
    }

    // Show edit form
    public function edit($id)
    {
        $member = ['name' => 'Alice', 'email' => 'alice@example.com'];

        return view('members.edit', compact('member'));
    }

    // Update a member
    public function update(Request $request, $id)
    {
        // Normally you'd validate and update DB
        return redirect()->route('members.index')
                         ->with('success', 'Member updated successfully!');
    }

    // Delete a member
    public function destroy($id)
    {
        // Normally you'd delete from DB
        return redirect()->route('members.index')
                         ->with('success', 'Member deleted successfully!');
    }
}
