<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Tag::factory(12)->make()->each(function (Tag $tagModel, int $key) {
            $tagModel->order = $key + 1;
            $tagModel->saveQuietly();
        });
    }
}
