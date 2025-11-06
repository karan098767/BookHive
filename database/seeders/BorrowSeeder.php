<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;

class BorrowSeeder extends Seeder
{
    public function run(): void
    {
        $members = Member::all();
        $books = Book::all();

        if ($members->isEmpty() || $books->isEmpty()) {
            $this->command->warn('No members or books available, skipping BorrowSeeder.');
            return;
        }

        foreach (range(1, 30) as $i) {
            $issueDate = Carbon::now()->subDays(rand(0, 30));
            $dueDate = (clone $issueDate)->addDays(14);
            $dateReturned = rand(0, 1) ? (clone $dueDate)->addDays(rand(0, 5)) : null;

            $lateFee = 0;
            if ($dateReturned && $dateReturned->gt($dueDate)) {
                $lateFee = $dateReturned->diffInDays($dueDate) * 100;
            }

            Borrow::create([
                'book_id' => $books->random()->id,
                'member_id' => $members->random()->id,
                'issue_date' => $issueDate,
                'due_date' => $dueDate,
                'date_returned' => $dateReturned,
                'late_fee' => $lateFee,
            ]);
        }
    }
}
