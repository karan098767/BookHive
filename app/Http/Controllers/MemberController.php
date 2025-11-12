<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::paginate(15);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'=>'required',
            'last_name'=>'nullable',
            'phone_number'=>'nullable',
            'email'=>'required|email|unique:members,email',
            'password'=>'required|min:6',
            'dob'=>'nullable|date'
        ]);

        $data['password'] = Hash::make($data['password']);
        Member::create($data);
        return redirect()->route('members.index')->with('success','Member created');
    }

    public function show(Member $member)
{
    $member->load('borrowings.book');
    return view('members.show', compact('member'));
}


    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'first_name'=>'required',
            'last_name'=>'nullable',
            'phone_number'=>'nullable',
            'email'=>'required|email|unique:members,email,'.$member->id,
            'password'=>'nullable|min:6',
            'dob'=>'nullable|date'
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $member->update($data);
        return redirect()->route('members.index')->with('success','Member updated');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success','Member deleted');
    }
}
