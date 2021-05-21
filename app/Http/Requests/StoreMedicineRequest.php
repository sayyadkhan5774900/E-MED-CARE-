<?php

namespace App\Http\Requests;

use App\Models\Medicine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMedicineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('medicine_create');
    }

    public function rules()
    {
        return [
            'pharmacy_id' => [
                'required',
                'integer',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'price' => [
                'required',
            ],
            'in_stock' => [
                'required',
            ],
            'expiry_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
