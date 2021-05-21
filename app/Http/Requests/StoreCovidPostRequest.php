<?php

namespace App\Http\Requests;

use App\Models\CovidPost;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCovidPostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('covid_post_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'excerpt' => [
                'string',
                'required',
            ],
            'detail' => [
                'required',
            ],
        ];
    }
}
