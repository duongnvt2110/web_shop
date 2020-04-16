<?php 

namespace App\Repositories\Category;

use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
    
    public function getModel()
    {
        return \App\Category::class;
    }

    public function paginate()
    {
        return $this->model->latest()->paginate(10);
    }
}