<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'publisher'        => $this->publisher,
            'author'           => $this->author,
            'genre'            => $this->genre,
            'book_publication' => $this->book_publication->format('Y-m-d'),
            'word_count'       => $this->word_count,
            'price_usd'        => (float) $this->price_usd, // Cast to float to ensure that price is always x.xx number
            'created_at'       => $this->created_at->toDateTimeString(),
        ];
    }
}