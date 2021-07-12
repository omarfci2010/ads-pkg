<?php

namespace Kwreach\Ads\Managers;

use Kwreach\Ads\Repositories\TagRepository;
use Kwreach\Ads\Resources\Tag\GetTagResource;
use Kwreach\Ads\Traits\ReusePropertiesTrait;
use Kwreach\Ads\Traits\StatusCodeTrait;

class TagManager
{
    use ReusePropertiesTrait, StatusCodeTrait;

    private function tag_repository(): TagRepository
    {
        return new TagRepository();
    }

    public function createTag($data): array
    {
        try {
            $category = $this->tag_repository()->insert($data);
            $this->success_data['data'] = new GetTagResource($category);
            $this->message = 'Tag Created Successfully';
            $this->response = $this->show_success($this->response, $this->message, $this->success_data);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function allTags(): array
    {
        try {
            $tags = $this->tag_repository()->get();
            $this->success_data['data'] = GetTagResource::collection($tags);
            $this->message = 'Tags List';
            $this->response = $this->show_success($this->response, $this->message, $this->success_data);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function tagDetails($id): array
    {
        try {
            $tag = $this->tag_repository()->find($id);
            if ($tag) {
                $this->success_data['data'] = new GetTagResource($tag);
                $this->message = 'Tag Details';
                $this->response = $this->show_success($this->response, $this->message, $this->success_data);
            } else {
                $this->message = "This Tag Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function editTag($data, $id): array
    {
        try {
            $tag = $this->tag_repository()->find($id);
            if ($tag) {
                $tag->update($data);
                $updated_tag = $tag->refresh();
                $this->success_data['data'] = new GetTagResource($updated_tag);
                $this->message = 'Tag Updated Successfully';
                $this->response = $this->show_success($this->response, $this->message, $this->success_data);
            } else {
                $this->message = "This Tag Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function deleteTag($id): array
    {
        try {
            $tag = $this->tag_repository()->delete($id);
            if ($tag) {
                $this->message = 'Tag Deleted Successfully';
                $this->response = $this->show_success($this->response, $this->message);
            } else {
                $this->message = "This Tag Not Found";
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
