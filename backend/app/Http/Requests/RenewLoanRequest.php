<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RenewLoanRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            "loanId" => $this->route("id"),
        ]);
    }

    public function rules()
    {
        return [
            "loanId" => ["uuid", "required"],
        ];
    }
}