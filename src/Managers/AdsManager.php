<?php

namespace Kwreach\Ads\Managers;

use Kwreach\Ads\Models\Ads;
use Kwreach\Ads\Repositories\AdsRepository;
use Kwreach\Ads\Resources\Ad\GetAdResource;
use Kwreach\Ads\Traits\ReusePropertiesTrait;
use Kwreach\Ads\Traits\StatusCodeTrait;

class AdsManager
{
    use ReusePropertiesTrait, StatusCodeTrait;

    private function ad_repository(): AdsRepository
    {
        return new AdsRepository();
    }

    public function createAd($data): array
    {
        try {
            $ad = $this->ad_repository()->insert($data);
            $this->success_data['data'] = new GetAdResource($ad);
            $this->message = 'Ad Created Successfully';
            $this->response = $this->show_success($this->response, $this->message, $this->success_data);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function allAds($filter_data): array
    {
        try {
            if (empty($filter_data)) {
                $ads = $this->ad_repository()->get();
            } else {
                $ads = new Ads();
                $ads = $this->filter_data($ads, $filter_data);
                $ads = $this->ad_repository()->get_filterData($ads);
            }
            $this->success_data['data'] = GetAdResource::collection($ads);
            $this->message = 'Ads List';
            $this->response = $this->show_success($this->response, $this->message, $this->success_data);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function adDetails($id): array
    {
        try {
            $ad = $this->ad_repository()->find($id);
            if ($ad) {
                $this->success_data['data'] = new GetAdResource($ad);
                $this->message = 'Ad Details';
                $this->response = $this->show_success($this->response, $this->message, $this->success_data);
            } else {
                $this->message = "This Ad Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function editAd($data, $id): array
    {
        try {
            $ad = $this->ad_repository()->find($id);
            if ($ad) {
                $ad->update($data);
                $updated_ad = $ad->refresh();
                $this->success_data['data'] = new GetAdResource($updated_ad);
                $this->message = 'Ad Updated Successfully';
                $this->response = $this->show_success($this->response, $this->message, $this->success_data);
            } else {
                $this->message = "This Ad Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    public function deleteAd($id): array
    {
        try {
            $ad = $this->ad_repository()->delete($id);
            if ($ad) {
                $this->message = 'Ad Deleted Successfully';
                $this->response = $this->show_success($this->response, $this->message);
            } else {
                $this->message = "This Ad Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    #advertiser Ads
    public function advertiserAds($advertiser_id): array
    {
        try {
            $advertiser = $this->ad_repository()->findAdvertiser($advertiser_id);
            if ($advertiser) {
                $ads = $advertiser->ads()->get();
                $this->success_data['data'] = GetAdResource::collection($ads);
                $this->message = 'Advertiser Ads Details';
                $this->response = $this->show_success($this->response, $this->message, $this->success_data);
            } else {
                $this->message = "This Advertiser Not Found";
                $this->response = $this->show_error($this->response, $this->message, $this->error_status);
            }

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->response = $this->show_error($this->response, $this->message, $this->error_status);
        } finally {
            return $this->response;
        }
    }

    private function filter_data(Ads $ads, $filter_data)
    {
        if (!empty($filter_data['category_ids'])) {
            if (is_array($filter_data['category_ids'])) {
                $ads = $ads->whereIn('category_id', $filter_data['category_ids']);
            } else {
                $ads = $ads->where('category_id', $filter_data['category_ids']);
            }
        }

        if (!empty($filter_data['tags_ids'])) {
            if (is_array($filter_data['tags_ids'])) {
                $tags_ids = $filter_data['tags_ids'];
                $ads = $ads->where(function ($query) use ($tags_ids) {
                    foreach ($tags_ids as $tag_id) {
                        $query->orWhereJsonContains('tags_ids', $tag_id);
                    }
                });
            } else {
                $ads = $ads->whereJsonContains('tags_ids', $filter_data['tags_ids']);
            }
        }
        return $ads;
    }
}
