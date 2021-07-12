<?php

namespace Kwreach\Ads\Resources\Ad;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
       return [
         "id" => $this->id ?? Null,
         "title" => $this->title ?? "",
         "type" => $this->type ?? "",
         "category_id" => $this->category_id ?? Null,
         "category_title" => $this->category->title ?? "",
         "advertiser_id" => $this->advertiser_id ?? Null,
         "advertiser_fullname" => $this->advertiser->full_name ?? "Null",
         "tags" => $this->tags_ids ?? [],
         "start_date" => $this->start_date ? Carbon::parse($this->start_date)->format('d-m-Y'): "",
         "description" => $this->description ?? "",
       ];
    }
}
