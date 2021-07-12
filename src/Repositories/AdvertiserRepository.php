<?php


namespace Kwreach\Ads\Repositories;

use Illuminate\Support\Facades\DB;
use Kwreach\Ads\Interfaces\AdsInterface;
use Kwreach\Ads\Models\Advertiser;

class AdvertiserRepository implements AdsInterface
{

    public function get(): \Illuminate\Support\Collection
    {
        return DB::table('categories')->get();
    }

    public function insert($criteria)
    {
        return Advertiser::create($criteria);
    }

    public function delete($criteria)
    {
        // TODO: Implement delete() method.
    }

    public function find($criteria_id)
    {
       return Advertiser::find($criteria_id);
    }
}
