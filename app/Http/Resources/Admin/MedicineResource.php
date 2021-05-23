<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'in_stock' => $this->in_stock,
            'expiry_date' => $this->expiry_date,
            'pharmacy_id' => $this->pharmacy_id,
            'pharmacy_name' => $this->pharmacy ? $this->pharmacy->name : $this->pharmacy,
            'category_id' => $this->category_id,
            'category_name' => $this->category ? $this->category->name : $this->category,
            'image_url' => $this->image->url,
            'image_thumbnail' => $this->image->thumbnail,
            'image_preview' => $this->image->preview,
        ];

    }
}
