<?php

use Illuminate\Database\Seeder;
use App\Model\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'id'=>1,
            'color'=>'赤'
        ]);
        Color::create([
            'id'=>2,
            'color'=>'青'
        ]);
        Color::create([
            'id'=>3,
            'color'=>'白'
        ]);
        Color::create([
            'id'=>4,
            'color'=>'黒'
        ]);
        Color::create([
            'id'=>5,
            'color'=>'緑'
        ]);
        Color::create([
            'id'=>6,
            'color'=>'無'
        ]);
    }
}
