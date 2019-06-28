<?php

namespace App\Policies;

use App\Admin;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(Admin $admin,Product $product){
        return $admin->id == $product->admin_id;
    }
    public function delete(Admin $admin,Product $product){
        return $admin->id == $product->admin_id;
    }
}
