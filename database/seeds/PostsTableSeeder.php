<?php

use App\User;
use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postsCount = (int)$this->command->ask('How many posts would you like?', 10);

        $users = User::all();

        factory(Post::class, $postsCount)->make()->each(function($post) use ($users) {
            $post->author_id = $users->random()->id;
            $post->save();
       });
    }
}
