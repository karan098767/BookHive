<?php

namespace Database\Factories;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BorrowFactory extends Factory
{
    protected $model = Borrow::class;

    public function definition()
    {
        $issue = $this->faker->dateTimeBetween('-60 days', 'now');
        $due = (clone $issue)->modify('+14 days');
        $dateReturned = $this->faker->boolean(70) ? $this->faker->dateTimeBetween($issue, $due) : null;

        $lateFee = null;
        if ($dateReturned && $dateReturned > $due) {
            $daysLate = (new Carbon($dateReturned))->diffInDays(new Carbon($due));
            $lateFee = $daysLate * 100;
        }

        return [
            'book_id' => Book::inRandomOrder()->first()->id ?? Book::factory()->create()->id,
            'member_id' => Member::inRandomOrder()->first()->id ?? Member::factory()->create()->id,
            'issue_date' => $issue,
            'due_date' => $due,
            'date_returned' => $dateReturned,
            'late_fee' => $lateFee,
        ];
    }
}
