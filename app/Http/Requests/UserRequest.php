<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UserRequest extends FormRequest
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
                $dateNow = Carbon::today();
                return [
                    'name'         => 'required|min:4|max:32',
                    'email'        => 'required|email|unique:users,email|max:255',
                    'address'      => 'required',
                    'avatar'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'phone'        => 'required|numeric|digits_between:10,15',
                    'password'     => 'required|min:8',
                    'birth_day'    => 'bail|required|date|before:' . $dateNow,
                    'role_id'      => 'required'
                ];

            case 'PUT':
                return [
                    'email'     => 'email|max:255|unique:users,email,' . $this->route('users'),
                    'name'      => 'required|min:4|max:50',
                    'phone'     => 'required|numeric|digits_between:10,15',
                    'address'   => 'required',
                    'avatar'    => 'image',
                    'birth_day' => 'bail|required|date',
                    'role_id'   => 'required'
                ];

            case 'PATCH':
                return [];

            default:
                break;
        }
    }
}
