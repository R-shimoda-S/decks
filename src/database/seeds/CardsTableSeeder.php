<?php

use Illuminate\Database\Seeder;
use App\Card;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<12;$i++) {
            Card::create([
            'deck_id'=>1,
            'card_id'=>$i+1,
            'number'=>4,
        ]);
        }
        Card::create([
            'deck_id'=>1,
            'card_id'=>13,
            'number'=>2,
        ]);
    }
}
