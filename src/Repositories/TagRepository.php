<?php


namespace Kwreach\Ads\Repositories;

use Illuminate\Support\Facades\DB;
use Kwreach\Ads\Interfaces\AdsInterface;
use Kwreach\Ads\Models\Advertiser;
use Kwreach\Ads\Models\Tag;

class TagRepository implements AdsInterface
{
    public function get(): \Illuminate\Support\Collection
    {
        return Tag::all();
    }

    public function insert($criteria)
    {
        return Tag::create($criteria);
    }

    public function delete($id): int
    {
        return Tag::destroy($id);
    }

    public function find($id)
    {
        return Tag::find($id);
    }
}
