<?php
namespace App\Admin\Repositories\Category;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Models\Category;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class CategoryRepository extends EloquentRepository implements
    CategoryRepositoryInterface
{

    public function getModel()
    {
        return Category::class;
    }
    public function getFlatTreeNotInNode(array $nodeId)
    {
        $this->getQueryBuilderOrderBy('position', 'ASC');
        $this->instance = $this->instance->whereNotIn('id', $nodeId)
            ->withDepth()
            ->get()
            ->toFlatTree();
        return $this->instance;
    }
    public function getFlatTree()
    {
        $this->getQueryBuilderOrderBy('position', 'ASC');
        $this->instance = $this->instance->withDepth()
            ->get()
            ->toFlatTree();
        return $this->instance;
    }
}
