<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PostCategory = collect([
            [
                'category' => 'Mobile',

            ],
            [
                'category' => 'Computer',

            ],
            [
                'category' => 'Car',

            ],
            [
                'category' => 'Sopport',

            ],
        ]);

        $PostCategory->each(function ($category) {
            PostCategory::create($category);
        });
    }
}
