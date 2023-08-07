<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Website;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MockDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $website = new Website();
        $website->name = "Twitter";
        $website->save();

        $website2 = new Website();
        $website2->name = "Facebook";
        $website2->save();

        $website3 = new Website();
        $website3->name = "Instagram";
        $website3->save();


        for ($i = 0; $i < 6; $i++) {
            $post = new Post();
            $post->title = "Post " . $i;
            $post->description = "Description " . $i;
            $post->content = "Hello World " . $i;
            $post->website_id = ($i % 3) + 1;
            $post->save();
        }

        for ($i = 0; $i < 6; $i++) {
            $faker = Factory::create();
            $subscriber = new Subscriber();
            $subscriber->email = $faker->email();
            $subscriber->website_id = ($i % 3) + 1;
            $subscriber->save();
        }


    }
}
