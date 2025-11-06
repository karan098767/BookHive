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
        $issueCarbon = Carbon::instance($issue);
        $due = (clone $issueCarbon)->addDays(14);

        // Decide if returned at all
        $wasReturned = $this->faker->boolean(80); // 80% returned

        $dateReturned = null;
        if ($wasReturned) {
            // 60% returned on/before due, 40% returned after due (some late)
            if ($this->faker->boolean(60)) {
                // returned on or before due
                $dateReturned = $this->faker->dateTimeBetween($issueCarbon, $due);
            } else {
                // returned after due (late) — within 1..10 days late
                $dateReturned = $this->faker->dateTimeBetween($due->addDay(), (clone $due)->addDays(10));
            }
        }

        $lateFee = null;
        if ($dateReturned) {
            $returnedCarbon = Carbon::instance($dateReturned);
            if ($returnedCarbon->greaterThan($due)) {
                $daysLate = $returnedCarbon->diffInDays($due);
                $lateFee = $daysLate * 100; 
            } else {
                $lateFee = 0;
            }
        }

        return [
            'book_id' => Book::inRandomOrder()->first()->id ?? Book::factory()->create()->id,
            'member_id' => Member::inRandomOrder()->first()->id ?? Member::factory()->create()->id,
            'issue_date' => $issueCarbon->toDateString(),
            'due_date' => $due->toDateString(),
            'date_returned' => $dateReturned ? Carbon::instance($dateReturned)->toDateString() : null,
            'late_fee' => $lateFee,
        ];
    }
}
