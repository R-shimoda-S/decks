<?php

use Illuminate\Database\Seeder;
use App\Deck;

class DecksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deck::create([
            'user_id'=>1,
            'name'=>Str::random(10),
        ]);
    }
}
