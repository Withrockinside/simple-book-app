<?php

namespace App\OpenApi\Annotations;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Simple Book App API",
    description: "A simple CRUD API for managing a book collection"
)]
#[OA\Server(
    url: "/api",
    description: "Main API Gateway"
)]
class BookAnnotations
{
    #[OA\Get(
        path: "/books",
        summary: "Get paginated list of books",
        operationId: "getBookList",
        tags: ["Books"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "data",
                            type: "array",
                            items: new OA\Items(ref: "#/components/schemas/Book")
                        ),
                        new OA\Property(property: "current_page", type: "integer", example: 1),
                        new OA\Property(property: "last_page",    type: "integer", example: 5),
                        new OA\Property(property: "per_page",     type: "integer", example: 10),
                        new OA\Property(property: "total",        type: "integer", example: 50),
                    ]
                )
            ),
        ]
    )]
    public function index() {}

    #[OA\Post(
        path: "/books",
        summary: "Create a new book",
        operationId: "storeBook",
        tags: ["Books"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/BookStoreRequest")
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Book created successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "data", ref: "#/components/schemas/Book")
                    ]
                )
            ),
            new OA\Response(response: 422, description: "Validation error"),
        ]
    )]
    public function store() {}

    #[OA\Get(
        path: "/books/{id}",
        summary: "Get a single book",
        operationId: "getBook",
        tags: ["Books"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"), example: 1)
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "data", ref: "#/components/schemas/Book")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Book not found"),
        ]
    )]
    public function show() {}

    #[OA\Put(
        path: "/books/{id}",
        summary: "Update a book",
        operationId: "updateBook",
        tags: ["Books"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"), example: 1)
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/BookUpdateRequest")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Book updated successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "data", ref: "#/components/schemas/Book")
                    ]
                )
            ),
            new OA\Response(response: 404, description: "Book not found"),
            new OA\Response(response: 422, description: "Validation error"),
        ]
    )]
    public function update() {}

    #[OA\Delete(
        path: "/books/{id}",
        summary: "Delete a book",
        operationId: "deleteBook",
        tags: ["Books"],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"), example: 1)
        ],
        responses: [
            new OA\Response(response: 204, description: "Book deleted successfully"),
            new OA\Response(response: 404, description: "Book not found"),
        ]
    )]
    public function destroy() {}
}