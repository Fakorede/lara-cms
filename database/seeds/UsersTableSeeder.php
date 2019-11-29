<?php

use App\User;
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
        $usersCount = max((int)$this->command->ask('How many users would you like?', 3), 1);
        factory(User::class)->states('admin-user')->create();
        factory(User::class, $usersCount)->create();

    }
}
