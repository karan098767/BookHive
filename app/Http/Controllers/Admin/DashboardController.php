<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Member;
use App\Models\Borrow;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $booksCount = Book::count();
        $membersCount = Member::count();
        $activeBorrows = Borrow::whereNull('date_returned')->count();
        $recentActivities = Borrow::latest()->take(10)->with(['book','member'])->get();

        return view('admin.dashboard', compact('booksCount','membersCount','activeBorrows','recentActivities'));
    }
}
