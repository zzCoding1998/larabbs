<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body', 'category_id', 'excerpt', 'slug'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function scopeWithOrder($query,$order)
    {
        switch ($order){
            case 'recent':
                $query->orderByDesc('created_at');
                break;
            default:
                $query->orderByDesc('updated_at');
                break;
        }
    }
}
