<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CovidPostResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'detail' => $this->detail,
            'image_url' => $this->image ? $this->image->url : '',
            'image_thumbnail' => $this->image ? $this->image->thumbnail : '',
            'image_preview' => $this->image ? $this->image->preview : '',
        ];
    }
}
