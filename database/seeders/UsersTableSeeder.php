<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();

        $user = User::first();
        $user->email = 'zhangsan@qq.com';
        $user->name = 'zhangsan';
        $user->password = bcrypt('zhangsan');
        $user->save();
    }
}
