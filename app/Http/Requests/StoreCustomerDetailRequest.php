<?php

namespace App\Http\Requests;

use App\Models\CustomerDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCustomerDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_detail_create');
    }

    public function rules()
    {
        return [
            'province' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
        ];
    }
}
