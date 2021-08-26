<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Laravel', 'Foundation', 'Slim', 'Bug', 'Help']);
        $tags->each(function ($t) {
            \App\Tag::create([
                'name' => $t,
                'slug' => \Str::slug($t),
            ]);
        });
    }
}
