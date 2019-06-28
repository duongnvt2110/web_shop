<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    /** @test */
    public function a_category_consist_of_a_product(){

        $category = factory('App\Category',1)->create();

        $product = factory('App\Product',1)->create(['category_id'=>$category[0]->id]);

        $this->assertTrue($category[0]->product->contains($product[0]));
    }
}
