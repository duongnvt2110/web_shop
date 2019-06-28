<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Category;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_admin_can_be_access_categories(){

        // login before checking
        $user = factory('App\User')->make();

        $this->be($user);

        // check status code
        $response = $this->get('/product/categories');

        $response->assertStatus(200);

    }

    /** @test */
    public function a_admin_can_be_create_a_new_category(){

        // login before checking
        $user = factory('App\User')->make();

        $this->be($user);

        $response = $this->post('/product/categories',[
            'name'=>'test',
            'slug'=>'test'
        ]);

        $response->assertStatus(200);
    }
}
