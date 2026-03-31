<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => ['sometimes', 'string', 'max:255'],
            'publisher'        => ['sometimes', 'string', 'max:255'],
            'author'           => ['sometimes', 'string', 'max:255'],
            'genre'            => ['sometimes', 'string', 'max:100'],
            'book_publication' => ['sometimes', 'date', 'before_or_equal:today'],
            'word_count'       => ['sometimes', 'integer', 'min:1'],
            'price_usd'        => ['sometimes', 'numeric', 'min:0'],
        ];
    }
}