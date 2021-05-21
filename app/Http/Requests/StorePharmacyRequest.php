<?php

namespace App\Http\Requests;

use App\Models\Pharmacy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePharmacyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pharmacy_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'opening_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'closing_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'longitude' => [
                'numeric',
            ],
            'latitude' => [
                'numeric',
            ],
        ];
    }
}
