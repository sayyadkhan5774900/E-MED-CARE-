<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'in_stock' => $this->in_stock,
            'expiry_date' => $this->expiry_date,
            'image_url' => $this->image ? $this->image->url : $this->image,
            'image_thumbnail' => $this->image ? $this->image->thumbnail : $this->image,
            'image_preview' => $this->image ? $this->image->preview : $this->image,
            'brand' => new BrandResource($this->brand),
            'pharmacy' =>  new PharmacyResource($this->pharmacy),
            'category' => new MedicinesCategoryResource($this->category),
        ];

    }
}
