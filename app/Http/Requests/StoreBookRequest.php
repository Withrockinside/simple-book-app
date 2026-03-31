<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => ['required', 'string', 'max:255'],
            'publisher'        => ['required', 'string', 'max:255'],
            'author'           => ['required', 'string', 'max:255'],
            'genre'            => ['required', 'string', 'max:100'],
            'book_publication' => ['required', 'date', 'before_or_equal:today'], // Book cannot have publication date in future
            'word_count'       => ['required', 'integer', 'min:1'],
            'price_usd'        => ['required', 'numeric', 'min:0', 'max:999999.99'], // Price must be a non-negative number
        ];
    }
}