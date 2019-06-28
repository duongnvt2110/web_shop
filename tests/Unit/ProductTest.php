<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ProductTest extends TestCase
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
    public function a_product_belongs_to_a_user(){

        $product = factory('App\Product',1)->create();

        $this->assertInstanceOf('App\User',$product[0]->user);

    }
    /** @test */
    public function a_product_belongs_to_a_category(){

        $product = factory('App\Product',1)->create();

        $this->assertInstanceOf('App\Category',$product[0]->category);

    }
    /** @test */
    public function a_product_can_be_created(){

        $product = factory('App\Product',1)->create();

        $this->assertDatabaseHas('products',[
            'user_id'=>$product[0]->user_id,
            'category_id'=>$product[0]->category_id,
            'product_name'=>$product[0]->product_name,
            'slug'=>str_slug($product[0]->product_name),
            'image'=>$product[0]->image,
            'short_description'=>$product[0]->short_description,
            'full_description'=>$product[0]->full_description,
            'published'=>$product[0]->published,
            'price'=>$product[0]->price,
            'tax'=>$product[0]->tax,
            'fee_ship'=>$product[0]->fee_ship,
        ]);

    }
}
