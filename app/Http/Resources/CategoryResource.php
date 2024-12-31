<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'DewyId' => $this->dewy_id,
            'name' => $this->name,
        ];
        if (isset($this->SubCollection) && $this->SubCollection()->count() > 0) {
            $data = array_merge($data, ['sub_categories' => CategoryResource::collection($this->SubCollection)]);
        }
        return $data;
    }
}
