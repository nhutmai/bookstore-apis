<?php

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('example', function () {
    expect(true)->toBeTrue();
});

test('test index returns all books', function () {
    Book::factory(3)->create();
    $response = $this->get('api/books');
    $response->assertStatus(200);
    $response->assertJsonCount(3);
});
