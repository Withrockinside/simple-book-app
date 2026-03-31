<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "BookStoreRequest",
    required: ["title", "publisher", "author", "genre", "book_publication", "word_count", "price_usd"],
    properties: [
        new OA\Property(property: "title",            type: "string",                   maxLength: 255,    example: "The Witcher"),
        new OA\Property(property: "publisher",        type: "string",                   maxLength: 255,    example: "SuperNowa"),
        new OA\Property(property: "author",           type: "string",                   maxLength: 255,    example: "Andrzej Sapkowski"),
        new OA\Property(property: "genre",            type: "string",                   maxLength: 100,    example: "Fantasy"),
        new OA\Property(property: "book_publication", type: "string",  format: "date",                    example: "1993-11-02"),
        new OA\Property(property: "word_count",       type: "integer",                  minimum: 1,        example: 120000),
        new OA\Property(property: "price_usd",        type: "number",  format: "float", minimum: 0, maximum: 999999.99, example: 29.99),
    ]
)]
class BookStoreRequestSchema {}