<?php

namespace Kwreach\Ads\Managers;

use Illuminate\Http\Resources\Json\JsonResource;
use Kwreach\Ads\Repositories\AdsRepository;
use Kwreach\Ads\Repositories\CategoryRepository;
use Kwreach\Ads\Resources\Category\GetCategoryResource;
use Kwreach\Ads\Traits\ReusePropertiesTrait;
use Kwreach\Ads\Traits\StatusCodeTrait;

class CategoryManager
{
    use ReusePropertiesTrait, StatusCodeTrait;

    private function category_repository(): CategoryRepository
    {
        return new CategoryRepository();
    }

    public function createCategory($data): array
    {
        try {
            $category = $this->category_repository()->insert($data);
            $this->success_data['data'] = new GetCategoryResource($category);
            $this->message = 'Category Created Successfully';
            $this->response = $this->show_success($this->response, $this->message, $this->success_data);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function allCategories(): array
    {
        try {
            $categories = $this->category_repository()->get();
            $this->success_data['data'] = GetCategoryResource::collection($categories);
            $this->message = 'Categories List';
            $this->response = $this->show_success($this->response, $this->message, $this->success_data);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function categoryDetails($id): array
    {
        try {
            $category = $this->category_repository()->find($id);
            if ($category) {
                $this->success_data['data'] = new GetCategoryResource($category);
                $this->message = 'Category Details';
                $this->response = $this->show_success($this->response, $this->message, $this->success_data);
            } else {
                $this->message = "This Category Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function editCategory($data, $id): array
    {
        try {
            $category = $this->category_repository()->find($id);
            if ($category) {
                $category->update($data);
                $updated_category = $category->refresh();
                $this->success_data['data'] = new GetCategoryResource($updated_category);
                $this->message = 'Category Updated Successfully';
                $this->response = $this->show_success($this->response, $this->message, $this->success_data);
            } else {
                $this->message = "This Category Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function deleteCategory($id): array
    {
        try {
            $category = $this->category_repository()->delete($id);
            if ($category) {
                $this->message = 'Category Deleted Successfully';
                $this->response = $this->show_success($this->response, $this->message);
            } else {
                $this->message = "This Category Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }
}
