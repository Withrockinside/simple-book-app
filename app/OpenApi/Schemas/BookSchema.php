<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Book",
    required: ["title", "publisher", "author", "genre", "book_publication", "word_count", "price_usd"],
    properties: [
        new OA\Property(property: "id",               type: "integer", readOnly: true,  example: 1),
        new OA\Property(property: "title",             type: "string",                   example: "The Witcher"),
        new OA\Property(property: "publisher",         type: "string",                   example: "SuperNowa"),
        new OA\Property(property: "author",            type: "string",                   example: "Andrzej Sapkowski"),
        new OA\Property(property: "genre",             type: "string",                   example: "Fantasy"),
        new OA\Property(property: "book_publication",  type: "string",  format: "date",  example: "1993-11-02"),
        new OA\Property(property: "word_count",        type: "integer", minimum: 1,      example: 120000),
        new OA\Property(property: "price_usd",         type: "number",  format: "float", example: 29.99, minimum: 0, maximum: 999999.99),
        new OA\Property(property: "created_at",        type: "string",  format: "date-time", readOnly: true),
        new OA\Property(property: "updated_at",        type: "string",  format: "date-time", readOnly: true),
        new OA\Property(property: "deleted_at",        type: "string",  format: "date-time", readOnly: true, nullable: true),
    ]
)]
class BookSchema {}