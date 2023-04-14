<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;
// use Symfony\Component\Console\Output\ConsoleOutput;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();
        $articles = Article::all();

        $articles->each(function ($article) use ($tags) {
            // $output = new ConsoleOutput();

            // $output->writeln($article->__toString());

            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}