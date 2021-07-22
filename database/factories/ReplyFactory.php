<?php

namespace Database\Factories;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition()
    {
        return [
            'content' => $this->faker->text(200),
            'user_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'topic_id' => mt_rand(1,100)
        ];
    }
}
