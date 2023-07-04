<?php

namespace Tests\Feature;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SnippetTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_an_anonymous_user_cant_create_a_snippet(): void
    {
        $response = $this->post('/snippet/save', [
            'title' => "test snippet",
            'description' => "lorem ipsum snippets",
            'code' => "lorem ipsum",
        ]);
        
        $this->assertDatabaseMissing('snippets', [
            'title' => "test snippet"
        ]);

        
    }
    
    
    public function test_a_logged_in_user_can_create_a_snippet(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->post('/snippet/save', [
                            'title' => "test snippet logged user",
                            'description' => "lorem ipsum snippets",
                            'code' => "lorem ipsum",
                        ]);
        
        $this->assertDatabaseHas('snippets', [
            'title' => "test snippet logged user"
        ]);
    }

    public function test_auth_user_can_like_a_snippet(): void{
        
        $user = User::factory()->create();

        $snippet = Snippet::factory()->create();

        $response = $this->actingAs($user)
            ->get('/snippet/' . $snippet->slug . '/like');

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'snippet_id' => $snippet->id
        ]);
    }
    
    public function test_auth_user_removes_like_from_a_snippet(): void
    {
        
        $user = User::factory()->create();

        $snippet = Snippet::factory()->create();

        $response = $this->actingAs($user)
            ->get('/snippet/' . $snippet->slug . '/like');
            
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'snippet_id' => $snippet->id
        ]);
        
        $response = $this->actingAs($user)
            ->get('/snippet/' . $snippet->slug . '/like');
    
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'snippet_id' => $snippet->id
        ]);


    }


    public function test_guest_user_cant_like_a_snippet(): void{

        $snippet = Snippet::factory()->create();

        $response = $this->get('/snippet/' . $snippet->slug . '/like');

        $this->assertDatabaseMissing('likes', [
            'snippet_id' => $snippet->id
        ]);

    }

        
}
