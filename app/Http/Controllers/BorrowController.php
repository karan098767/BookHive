<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function index()
    {
        $records = Borrow::with(['book','member'])->latest()->paginate(20);
        return view('borrow.index', compact('records'));
    }

    public function create()
    {
        $books = Book::where('copies','>',0)->get();
        $members = Member::where('is_active',true)->get();
        return view('borrow.create', compact('books','members'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'issue_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:issue_date',
        ]);

        // Default issue_date = today if not provided
        $issueDate = isset($data['issue_date']) ? \Carbon\Carbon::parse($data['issue_date']) : \Carbon\Carbon::today();
        // Default due_date = issue_date + 14 days if not provided
        $dueDate = isset($data['due_date']) ? \Carbon\Carbon::parse($data['due_date']) : $issueDate->copy()->addDays(14);

        $borrow = \App\Models\Borrow::create([
            'book_id' => $data['book_id'],
            'member_id' => $data['member_id'],
            'issue_date' => $issueDate->toDateString(),
            'due_date' => $dueDate->toDateString(),
            'date_returned' => null,
            'late_fee' => null,
        ]);

        // Decrement copies and update book status
        $book = \App\Models\Book::find($data['book_id']);
        if ($book->copies > 0) {
            $book->decrement('copies');
            $book->increment('total_borrow_count');
            $book->status = $book->copies - 1 > 0 ? 'available' : 'borrowed';
            $book->save();
        }

        // increment member borrowed counter
        $member = \App\Models\Member::find($data['member_id']);
        $member->increment('total_books_borrowed');

        return redirect()->route('borrow.index')->with('success', 'Book issued successfully.');
    }


    public function edit(Borrow $borrow)
    {
        return view('borrow.edit', compact('borrow'));
    }

    public function update(Request $request, Borrow $borrow)
    {
        $data = $request->validate([
            'date_returned'=>'nullable|date|after_or_equal:issue_date'
        ]);

        if (!empty($data['date_returned'])) {
            $borrow->date_returned = $data['date_returned'];

            $due = Carbon::parse($borrow->due_date);
            $returned = Carbon::parse($data['date_returned']);

            $borrow->late_fee = $returned->gt($due)
                ? $due->diffInDays($returned) * 100
                : 0;

            $borrow->save();

            $book = $borrow->book;
            $book->increment('copies');
            if ($book->copies > 0) {
                $book->status = 'available';
                $book->save();
            }
}


        return redirect()->route('borrow.index')->with('success','Borrow record updated');
    }

    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return redirect()->route('borrow.index')->with('success','Record deleted');
    }
}
