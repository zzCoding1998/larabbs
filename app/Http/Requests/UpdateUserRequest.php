<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:200',
            'avatar' => 'mimes:jpg,jpeg,gif,png|dimensions:min_width=208,min_height=208'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.between' => '用户名必须在3-25个字符之间',
            'name.regex' => '用户名必须以字母或数字开头结尾',
            'name.unique' => '用户名已被占用',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'introduction.max' => '自我介绍不能大于200个字符长度',
            'avatar.mimes' => '仅支持jpeg,jpg,gif,png等格式文件的上传',
            'avatar.dimensions' => '图片像素值必须大于208*208'
        ];
    }
}
