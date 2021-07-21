<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'title' => 'required|min:2',
                    'body' => 'required|min:2',
                    'category_id' => 'required|numeric'
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            'title.min' => '标题不能少于2个字符',
            'body.min' => '内容不能少于2个字符',
            'category_id.numeric' => '分类必须为数字'
        ];
    }
}
