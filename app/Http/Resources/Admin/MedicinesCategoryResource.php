<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicinesCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_category_id' => $this->parent_category_id,
            'parent_category_name' => $this->parent_category ? $this->parent_category->name : $this->parent_category,
            'image_url' => $this->image? $this->image->url : $this->image,
            'image_thumbnail' => $this->image ? $this->image->thumbnail : $this->image,
            'image_preview' => $this->image ? $this->image->preview : $this->image,
        ];

    }
}
