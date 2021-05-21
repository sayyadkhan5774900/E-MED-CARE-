<?php

namespace App\Http\Requests;

use App\Models\CovidPost;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCovidPostRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('covid_post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:covid_posts,id',
        ];
    }
}
