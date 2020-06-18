<?php

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseFormRequest;

class TaskRequest extends BaseFormRequest
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
                'task_title' => 'required|string|unique:tasks,task_title,'.request()->id,
                'project_id' => 'required|numeric|exists:projects,id',
                'status' => 'numeric|in:0,1',
            ];
        }else{
            return [
                'task_title' => 'required|string|unique:tasks,task_title',
                'project_id' => 'required|numeric|exists:projects,id',
                'status' => 'numeric|in:0,1',
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
            'task_title.required' => 'title is required',
            'task_title.unique' => 'title must be unique',
            'project_id.required' => 'project is required',
            'status.in' => 'status must be in the same value',
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
            'task_title'  => 'trim|escape|lowercase',
            'project_id'  =>  'trim|escape|digit',
            'status'  =>  'trim|escape|digit'
        ];
    }
}
