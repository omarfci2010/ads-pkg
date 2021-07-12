<?php

namespace Kwreach\Ads\Resources\Tag;

use Illuminate\Http\Resources\Json\JsonResource;

class GetTagResource extends JsonResource
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
         "description" => $this->description ?? "",
       ];
    }
}
