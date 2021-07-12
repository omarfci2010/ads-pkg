<?php


namespace Kwreach\Ads\Repositories;

use Illuminate\Support\Facades\DB;
use Kwreach\Ads\Interfaces\AdsInterface;
use Kwreach\Ads\Models\Category;

class CategoryRepository implements AdsInterface
{

    public function get(): \Illuminate\Support\Collection
    {
        return Category::all();
    }

    public function insert($criteria)
    {
        return Category::create($criteria);
    }

    public function delete($id): int
    {
        return Category::destroy($id);
    }

    public function find($id)
    {
        return Category::find($id);
    }
}
