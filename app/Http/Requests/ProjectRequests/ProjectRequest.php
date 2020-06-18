<?php

namespace App\Http\Requests\ProjectRequests;

use App\Http\Requests\BaseFormRequest;

class ProjectRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request('id')){
            return [
                'title' => 'required|string|max:255|min:3|unique:projects,title,'.request()->id
            ];
        }else{
            return [
                'title' => 'required|string|max:255|min:3|unique:projects,title'
            ];
        }

    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'title is Required',
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'title'  => 'trim|escape|lowercase'
        ];
    }
}
