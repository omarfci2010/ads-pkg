<?php

namespace Kwreach\Ads\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kwreach\Ads\Managers\TagManager;
use Kwreach\Ads\Requests\Tag\AddTagRequest;
use Kwreach\Ads\Requests\Tag\EditTagRequest;
use Kwreach\Ads\Traits\ReusePropertiesTrait;

class TagController extends Controller
{
    use ReusePropertiesTrait;

    public function tag_manager(): TagManager
    {
        return new TagManager();
    }

    public function add(AddTagRequest $request): JsonResponse
    {
        $data = $request->validated();
        $category = $this->tag_manager()->createTag($data);
        return response()->json($category, $this->status_code);
    }

    public function allCategories(Request $request): JsonResponse
    {
        $category = $this->tag_manager()->allTags();
        return response()->json($category, $this->status_code);
    }

    public function categoryDetails($id): JsonResponse
    {
        $category = $this->tag_manager()->tagDetails($id);
        return response()->json($category, $this->status_code);
    }


    public function edit(EditTagRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $category = $this->tag_manager()->editTag($data, $id);
        return response()->json($category, $this->status_code);
    }

    public function delete($id): JsonResponse
    {
        $category = $this->tag_manager()->deleteTag($id);
        return response()->json($category, $this->status_code);
    }
}
