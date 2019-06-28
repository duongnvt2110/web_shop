<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    // protected $product;

    // public function setUp()
    // {
    //     parent::setUp();
    //     $this->user = create('App\User')->create();
    //     $this->be($this->user);
    // }
    /** @test */
    public function testExample(){

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_admin_can_be_access_new_product(){
        // login before verified
        $user = factory('App\User')->make();

        $this->be($user);

        $response = $this->get('/product/create');

        $response->assertStatus(200);
    }
    /** @test */
    public function a_admin_can_be_access_all_product(){
        // login before verified
        $user = factory('App\User')->make();

        $this->be($user);

        $response = $this->get('/product/show');

        $response->assertStatus(200);

    }

    /** @test */
    public function a_admin_can_not_access_new_product(){

        $response = $this->get('/product/create');
        // http not found
        $response->assertStatus(302);
    }
    /** @test */
    public function a_admin_can_not_access_all_product(){

        $response = $this->get('/product/show');
        // http not found
        $response->assertStatus(302);

    }
}
