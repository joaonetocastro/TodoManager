<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    public function testListing()
    {
        $response = $this->get('/api/todos');
        $response->assertStatus(200);
    }
    public function testStoring()
    {
        $response = $this->post('/api/todos', [
            'title' => 'my todo',
            ]);
        $response
        // ->assertStatus(200)
        ->assertJson([
            'title' => 'my todo',
            'done' => false
        ]);
    }
    public function testUpdating()
    {
        $todo= \App\Todo::create(
            ['title' => 'title 1']
        );
        $response = $this->put('/api/todos/'.$todo->id, [
            'title' => 'my todo updated through test',
            'done' => true
        ]);
        $response
        // ->assertStatus(200)
        ->assertJson([
            'title' => 'my todo updated through test',
            'done' => true
        ]);
    }
    
    public function testDeleting()
    {
        $todo= \App\Todo::create(
            ['title' => 'title 1']
        );
        $response = $this->delete('/api/todos/'.$todo->id);
        $response
        // ->assertStatus(200)
        ->assertJson([
            'id' => $todo->id
        ]);
    }
    
}
