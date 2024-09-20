<?php

namespace Database\Factories;

use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        $book = Book::inRandomOrder()->first();
        $loanDate = $this->faker->dateTimeBetween("-1 month", "now");
        $returnDate = (clone $loanDate)->modify("+7 days");
        $now = new DateTime();
        $returned_at = $this->faker->optional()->dateTimeBetween($loanDate, $returnDate);
        $status = is_null($returned_at) ? ($returnDate < $now ? 'overdue' : 'active') : 'finished';
        return [
            'id' => $this->faker->uuid(),
            'book_id' => $book->id,
            'loan_date' => $loanDate,
            'return_date' => $returnDate,
            'returned_at' => $returned_at,
            'status' => $status,
            'renewal_count' => 0,
            'last_renewed_at' => null,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
    }
}
