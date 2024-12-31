<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource2 extends JsonResource
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
            'name_en' => $this->name_en,
            'name' => $this->name,
        ];
        if (isset($this->SubCollection) && $this->SubCollection()->count() > 0) {
            $data = array_merge($data, ['sub_categories' => CategoryResource2::collection($this->SubCollection)]);
        }
        return $data;
    }
}
