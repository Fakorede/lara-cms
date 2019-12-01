<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => 'Ui design',
                'slug' => 'ui-design'
            ],
            [
                'title' => 'Software development',
                'slug' => 'software-development'
            ],
            [
                'title' => 'Internet',
                'slug' => 'internet'
            ],
            [
                'title' => 'Social media',
                'slug' => 'social-media'
            ],
            [
                'title' => 'Freelancing',
                'slug' => 'freelancing'
            ],
        ]);

        // update posts
        for($id = 1; $id <= 10; $id++)
        {
            $category_id = rand(1, 5);
            DB::table('posts')
                ->where('id', $id)
                ->update(['category_id' => $category_id]);
        }
    }
}
