<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;
    public function definition()
    {
        $published = $this->faker->date();
        return [
            'isbn' => $this->faker->isbn13(),
            'title' => $this->faker->sentence(3),
            'author_id' => Author::inRandomOrder()->first()->id ?? Author::factory()->create()->id,
            'genre' => $this->faker->randomElement(['Fiction','Non-Fiction','Sci-Fi','Fantasy','Romance','Mystery']),
            'published_date' => $published,
            'copies' => $this->faker->numberBetween(1, 6),
            'status' => 'available',
            'pdf_link' => null,
            'total_borrow_count' => 0,
        ];
    }
}
