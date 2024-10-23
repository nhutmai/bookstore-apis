<?php
namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use DatabaseTransactions;
    protected  function setUp(): void
    {
        parent::setUp();
        $this->markTestSkipped();
    }
    public function test_index_return_all_books(){
        $this->markTestIncomplete('skipppppp');
//        Book::factory(3)->create();
        $response = $this->get('/api/books');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_index_return_a_book(){
        $book=Book::factory()->create();
        $response= $this->get('/api/books/'.$book->id);
        $response->assertStatus(200);
        $response->assertJson([
            'id'=>$book->id,
            'title'=>$book->title,
        ]);
    }

    public function test_store_book(){
        $bookData= [
            'title'=>'test title',
            'author'=>'test author',
            'price'=>12,
        ];
        $response = $this->post('/api/books',$bookData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('books',$bookData);
    }

    public function test_update_book(){
        $book=Book::factory()->create();

        $updateData=[
            'title'=>'updated title',
            'author'=>'updated author',
            'price'=>12,
        ];

        $response=$this->put('api/books/'.$book->id,$updateData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('books',$updateData);
    }

    public function test_delete_book(){
        $book=Book::factory()->create();
        $response=$this->delete('api/books/'.$book->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('books',['id'=>$book->id]);
    }

    public function test_search_book(){
        $book1=Book::factory()->create([
            'title'=>'laravel title1',
        ]);
        $book2=Book::factory()->create([
            'title'=>'test title2',
        ]);
        $response=$this->get('/api/books/search/laravel');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJson([
           ['title'=>'laravel title1'],
        ]);
    }

    public function test_filter_book(){
        $book1=Book::factory()->create([
            'author'=>'author1',
        ]);
        $book2=Book::factory()->create([
            'author'=>'author2',
        ]);
        $response=$this->get('/api/books/filter/or1');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJson([
            ['author'=>'author1'],
        ]);
    }
}






