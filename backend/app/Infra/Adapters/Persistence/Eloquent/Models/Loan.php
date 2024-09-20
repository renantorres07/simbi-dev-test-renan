<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models;

use Database\Factories\LoanFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'loans';

    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'book_id',
        'loan_date',
        'return_date',
        'returned_at',
        'status',
        'renewal_count',
        'last_renewed_at',
        'created_at',
        'updated_at',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    protected static function newFactory(): Factory
    {
        return LoanFactory::new();
    }
}
