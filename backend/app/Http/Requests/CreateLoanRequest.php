<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            "bookIds" => ["string", "required"],
            "loanDate" => ["date", "nullable"],
            "returnDate" => ["date", "nullable"],
        ];
    }
}
