<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'user_id', 'content'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function topic()
    {
        return $this->hasOne(Topic::class,'id','topic_id');
    }
}
