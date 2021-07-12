<?php

namespace Kwreach\Ads\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kwreach\Ads\Managers\CategoryManager;
use Kwreach\Ads\Requests\Category\AddCategoryRequest;
use Kwreach\Ads\Requests\Category\EditCategoryRequest;
use Kwreach\Ads\Traits\ReusePropertiesTrait;


class CategoryController extends Controller
{
    use ReusePropertiesTrait;

    public function category_manager(): CategoryManager
    {
        return new CategoryManager();
    }

    public function add(AddCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();
        $category = $this->category_manager()->createCategory($data);
        return response()->json($category, $this->status_code);
    }

    public function allCategories(Request $request): JsonResponse
    {
        $category = $this->category_manager()->allCategories();
        return response()->json($category, $this->status_code);
    }

    public function categoryDetails($id): JsonResponse
    {
        $category = $this->category_manager()->categoryDetails($id);
        return response()->json($category, $this->status_code);
    }


    public function edit(EditCategoryRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $category = $this->category_manager()->editCategory($data, $id);
        return response()->json($category, $this->status_code);
    }

    public function delete($id): JsonResponse
    {
        $category = $this->category_manager()->deleteCategory($id);
        return response()->json($category, $this->status_code);
    }
}
