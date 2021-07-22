<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'topic_id' => 'required|exists:topics,id',
                    'content' => 'required|max:200|min:2'
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
            'content.max' => '回复内容长度不能超过200个字符',
            'content.min' => '回复内容长度不能少于2个字符',
            'content.required' => '回复内容不能为空',
            'topic_id' => '非法数据，请刷新页面重试'
        ];
    }
}
