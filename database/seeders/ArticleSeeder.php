<?php

namespace Database\Seeders;

use Database\Factories\ArticleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleFactory::times(100)->create();
    }
}
