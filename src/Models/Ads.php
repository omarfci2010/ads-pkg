<?php

namespace Kwreach\Ads\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kwreach\Ads\Resources\Tag\GetTagResource;

class Ads extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "ads";
    protected $guarded = [];
    protected $casts = ["tags_ids" => "array"];


    public function setTagsIdsAttribute($tags_ids)
    {
        if (is_array($tags_ids)) {
            $this->attributes['tags_ids'] = json_encode($tags_ids);
        }
    }

    public function getTagsIdsAttribute($tags_ids)
    {

        $tags = json_decode($tags_ids, true);
        if (!empty($tags)) {
            $tags = Tag::whereIn('id', $tags)->get();
            return GetTagResource::collection($tags);
        } else {
            return [];
        }

    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
      return  $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function advertiser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Advertiser::class, 'advertiser_id', 'id');
    }
}
