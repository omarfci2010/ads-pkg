<?php

namespace Kwreach\Ads\Managers;

use Kwreach\Ads\Repositories\AdsRepository;
use Kwreach\Ads\Resources\Category\GetCategoryResource;
use Kwreach\Ads\Traits\ReusePropertiesTrait;
use Kwreach\Ads\Traits\StatusCodeTrait;

class AdvertiserManager
{
    use ReusePropertiesTrait, StatusCodeTrait;

    private function ads_repository(): AdsRepository
    {
        return new AdsRepository();
    }

    public function createCategory($data): array
    {
        try {
            $category = $this->ads_repository()->insert($data);
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

    public function AllCategories($data): array
    {
        try {
            $category = $this->ads_repository()->insert($data);
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

    public function categoryDetails($data, $id): array
    {
        try {
            $category = $this->ads_repository()->find($id);
            if ($category) {
                $category->update($data);
                $updated_category = $category->refresh();
                $this->success_data['data'] = new GetCategoryResource($updated_category);
                $this->message = 'Category Created Successfully';
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
            $category = $this->ads_repository()->find($id);
            if ($category) {
                $category->update($data);
                $updated_category = $category->refresh();
                $this->success_data['data'] = new GetCategoryResource($updated_category);
                $this->message = 'Category Created Successfully';
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

    public function deleteCategory($data, $id): array
    {
        try {
            $category = $this->ads_repository()->find($id);
            if ($category) {
                $category->update($data);
                $updated_category = $category->refresh();
                $this->success_data['data'] = new GetCategoryResource($updated_category);
                $this->message = 'Category Created Successfully';
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
}
