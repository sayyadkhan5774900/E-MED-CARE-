<?php

namespace App\Http\Requests;

use App\Models\CovidPost;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCovidPostRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('covid_post_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'excerpt' => [
                'string',
                'nullable',
            ],
        ];
    }
}
