<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $category_ids = Category::pluck('id')->toArray();


        for ($i = 0; $i < 53; $i++) {
            $post = new Post();
            $post->user_id = 1;
            $post->category_id = Arr::random($category_ids);
            $post->title = $faker->text(50);
            $post->content = $faker->paragraphs(2, true);
            $post->image = $faker->imageUrl(250, 250);
            $post->slug = Str::slug($post->title, '-');
            $post->save();
        }
    }
}
