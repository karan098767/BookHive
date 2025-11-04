<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    public function run(): void
    {

        if (Author::count() === 0) {
            Author::factory()->count(10)->create();
        }

        Book::factory()->count(60)->create();
    }
}
