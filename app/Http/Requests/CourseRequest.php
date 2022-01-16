<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];

            case 'POST':
                return [
                    'course_name'   => 'required|min:4|max:32',
                    'description'   => 'required|max:255',
                    // 'requirement'   => 'required|max:255',
                    'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
                    'price'         => 'required|numeric|digits_between:1,10',
                ];

            case 'PUT':
                return [
                    'course_name'   => 'required|min:4|max:32',
                    'description'   => 'required|max:255',
                    // 'requirement'   => 'required|max:255',
                    'price'         => 'required|numeric|digits_between:1,10',
                ];

            case 'PATCH':
                return [];

            default:
                break;
        }
    }
}
