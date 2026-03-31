<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    // We have in-memory sqlite db configured in phpunit.xml, so this won't wipe our actual db
    use RefreshDatabase;

    /**
     * Test creating a book via POST.
     */
    public function test_can_create_a_book(): void
    {
        $payload = [
            'title' => 'The Witcher',
            'publisher' => 'SuperNowa',
            'author' => 'Andrzej Sapkowski',
            'genre' => 'Fantasy',
            'book_publication' => '1992-11-15',
            'word_count' => 78000,
            'price_usd' => 29.99,
        ];

        $response = $this->postJson('/api/books', $payload);

        $response->assertStatus(201)
                 ->assertJsonPath('data.title', 'The Witcher');

        $this->assertDatabaseHas('books', ['title' => 'The Witcher']);
    }

    /**
     * Test retrieving a single book via GET.
     */
    public function test_can_get_a_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('data.id', $book->id);
    }

    /**
     * Test updating a book via PATCH.
     */
    public function test_can_update_a_book(): void
    {
        $book = Book::factory()->create(['title' => 'Old Title']);

        $response = $this->patchJson("/api/books/{$book->id}", [
            'title' => 'New Title'
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.title', 'New Title');

        $this->assertDatabaseHas('books', ['title' => 'New Title']);
    }

    /**
     * Test deleting a book via DELETE.
     */
    public function test_can_delete_a_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(204);
        
        // We are using SoftDeletes, check that it's trashed
        $this->assertSoftDeleted('books', ['id' => $book->id]);
    }

    /**
     * Test validation logic.
     */
    public function test_creation_requires_all_fields(): void
    {
        $response = $this->postJson('/api/books', []); // Empty payload

        $response->assertStatus(422)
                 ->assertJsonValidationErrors([
                    'title',
                    'publisher',
                    'author',
                    'genre',
                    'book_publication',
                    'word_count',
                    'price_usd',
                ]);
    }

    /**
     * Test price validation logic specifically. We use data provider for validation scenarios
     */
    #[DataProvider('invalidPriceProvider')]
    public function test_price_validation_rules(mixed $invalidPrice): void
    {
        $response = $this->postJson('/api/books', [
            'title' => 'Test Book',
            'publisher' => 'Test Pub',
            'author' => 'Test Author',
            'genre' => 'Test Genre',
            'book_publication' => '2024-01-01',
            'word_count' => 100,
            'price_usd' => $invalidPrice, // Injecting bad data
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['price_usd']);
    }

    /**
     * Data provider for price validation scenarios.
     */
    public static function invalidPriceProvider(): array
    {
        return [
            'price is a string'   => ['not-a-number'],
            'price is negative'   => [-10.50],
        ];
    }
}