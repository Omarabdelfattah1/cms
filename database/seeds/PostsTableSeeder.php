<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Post;
use App\Category;
use App\Tag;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auther1=User::create([
            'name'=>'Omar',
            'email'=>'omar@example.com',
            'password'=>Hash::make('password'),
        ]);        

        $category=Category::create([
        	'name'=>'News',
        ]);

        $category1=Category::create([
        	'name'=>'Marketings',
        ]);

        $category2=Category::create([
        	'name'=>'Products',
        ]);

        $post=$auther1->Posts()->create([
        	'title'=>'We relocated our office to a new designed garage',
        	'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        	'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        	'category_id'=>$category->id,
        	'image'=>  'posts/1.jpg',

        ]);

        $post1=$auther1->Posts()->create([
        	'title'=>'We relocated our office to a new designed garage',
        	'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        	'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        	'category_id'=>$category2->id,
        	'image'=>  'posts/2.jpg',

        ]);

        $post2=$auther1->Posts()->create([
        	'title'=>'We relocated our office to a new designed garage',
        	'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        	'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        	'category_id'=>$category2->id,
        	'image'=>  'posts/3.jpg',

        ]);

        $post3=$auther1->Posts()->create([
        	'title'=>'We relocated our office to a new designed garage',
        	'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        	'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        	'category_id'=>$category1->id,
        	'image'=>  'posts/4.jpg',

        ]);
    
        $tag=Tag::create([
        	'name'=>'job',
        ]);

        $tag1=Tag::create([
        	'name'=>'customers',
        ]);

        $tag2=Tag::create([
        	'name'=>'design',
        ]);

        $post->tags()->attach([$tag->id,$tag1->id]);
        $post1->tags()->attach([$tag2->id,$tag1->id]);
        $post2->tags()->attach([$tag->id,$tag1->id]);
        $post3->tags()->attach([$tag->id,$tag2->id]);
    }
}
