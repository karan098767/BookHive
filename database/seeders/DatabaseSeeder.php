<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\Member;
use App\Models\Borrow;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // create admin
        Admin::factory()->create();

        // authors
        Author::factory()->count(15)->create();

        // books
        Book::factory()->count(60)->create();

        // members
        Member::factory()->count(30)->create();

        // borrow records
        Borrow::factory()->count(80)->create();

        // Update total_books_borrowed and book total_borrow_count
        foreach (Member::all() as $member) {
            $count = $member->borrowings()->count();
            $member->update(['total_books_borrowed' => $count]);
        }

        foreach (Book::all() as $book) {
            $book->update(['total_borrow_count' => $book->borrowings()->count()]);
        }
    }
}
