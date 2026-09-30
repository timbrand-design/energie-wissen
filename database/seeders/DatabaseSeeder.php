<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $users = User::factory(3)->create();

        $users->get(0)->assignRole('admin');
        $users->get(1)->assignRole('author');
        $users->get(2)->assignRole('user');

        $categories = Category::factory(4)->create();

        $articles = collect();

        foreach ($categories as $category) {
            $createdArticles = Article::factory(2)
                ->for($users->random(), 'user')
                ->for($category, 'category')
                ->create();

            $articles = $articles->merge($createdArticles);
        }

        foreach ($articles as $article) {
            Comment::factory(2)
                ->for($users->random(), 'user')
                ->for($article, 'article')
                ->create();
        }
    }
}