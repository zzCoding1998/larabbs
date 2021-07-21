<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'body' => $this->faker->text,
            'user_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'category_id' => $this->faker->randomElement([1,2,3,4]),
            'excerpt' => $title
        ];
    }
}
