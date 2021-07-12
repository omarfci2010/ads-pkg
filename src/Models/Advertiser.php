<?php

namespace Kwreach\Ads\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertiser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "advertisers";
    protected $guarded = [];

    public function ads(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ads::class, 'advertiser_id', 'id');
    }
}
