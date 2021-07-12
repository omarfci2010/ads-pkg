<?php

namespace Kwreach\Ads\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kwreach\Ads\Managers\AdsManager;
use Kwreach\Ads\Requests\Ad\AddAdRequest;
use Kwreach\Ads\Requests\Ad\EditAdRequest;
use Kwreach\Ads\Requests\Ad\GetAdsFiltersRequest;
use Kwreach\Ads\Traits\ReusePropertiesTrait;

class AdsController extends Controller
{
    use ReusePropertiesTrait;

    public function ads_manager(): AdsManager
    {
        return new AdsManager();
    }

    public function add(AddAdRequest $request): JsonResponse
    {
        $data = $request->validated();
        $category = $this->ads_manager()->createAd($data);
        return response()->json($category, $this->status_code);
    }

    public function allAds(GetAdsFiltersRequest $request): JsonResponse
    {
        $filter_data = $request->validated();
        $category = $this->ads_manager()->allAds($filter_data);
        return response()->json($category, $this->status_code);
    }

    public function adDetails($id): JsonResponse
    {
        $category = $this->ads_manager()->adDetails($id);
        return response()->json($category, $this->status_code);
    }

    public function edit(EditAdRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $category = $this->ads_manager()->editAd($data, $id);
        return response()->json($category, $this->status_code);
    }

    public function delete($id): JsonResponse
    {
        $category = $this->ads_manager()->deleteAd($id);
        return response()->json($category, $this->status_code);
    }

    #Advertiser Ads
    public function advertiserAds($advertiser_id): JsonResponse
    {
        $category = $this->ads_manager()->advertiserAds($advertiser_id);
        return response()->json($category, $this->status_code);
    }
}
