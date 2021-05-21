<?php

namespace App\Http\Requests;

use App\Models\MedicinesCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMedicinesCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('medicines_category_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
