<?php


namespace Kwreach\Ads\Repositories;

use Illuminate\Support\Facades\DB;
use Kwreach\Ads\Interfaces\AdsInterface;
use Kwreach\Ads\Models\Ads;
use Kwreach\Ads\Models\Advertiser;

class AdsRepository implements AdsInterface
{
    public function get(): \Illuminate\Support\Collection
    {
        return Ads::all();
    }

    public function get_filterData($criteria)
    {
        return $criteria->get();
    }

    public function insert($criteria)
    {
        return Ads::create($criteria);
    }

    public function delete($id): int
    {
        return Ads::destroy($id);
    }

    public function find($id)
    {
        return Ads::find($id);
    }

    public function findAdvertiser($advertiser_id)
    {
        return Advertiser::find($advertiser_id);
    }
}
