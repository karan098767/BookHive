<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\Member;

class BorrowSeeder extends Seeder
{
    public function run(): void
    {
        // If no books or members exist, create some
        if (Book::count() === 0) {
            Book::factory()->count(10)->create();
        }

        if (Member::count() === 0) {
            Member::factory()->count(10)->create();
        }

        Borrow::factory()->count(80)->create();

        // Update totals for consistency
        foreach (Member::all() as $member) {
            $member->update([
                'total_books_borrowed' => $member->borrows()->count(),
            ]);
        }

        foreach (Book::all() as $book) {
            $book->update([
                'total_borrow_count' => $book->borrows()->count(),
            ]);
        }
    }
}
