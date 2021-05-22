<?php

namespace App\Http\Requests;

use App\Models\MedicinesCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMedicinesCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('medicines_category_create');
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
