<?php

namespace App\Http\Requests;

use App\Models\Medicine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMedicineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('medicine_edit');
    }

    public function rules()
    {
        return [
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
            'expiry_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
