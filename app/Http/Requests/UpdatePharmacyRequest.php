<?php

namespace App\Http\Requests;

use App\Models\Pharmacy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePharmacyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pharmacy_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'opening_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'closing_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'longitude' => [
                'numeric',
                'required',
            ],
            'latitude' => [
                'numeric',
                'required',
            ],
            'owner_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
