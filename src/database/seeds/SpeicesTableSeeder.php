<?php

use Illuminate\Database\Seeder;
use App\Model\Speices;

class SpeicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speices::create([
            'id'=>1,
            'speices'=>'ミソス'
        ]);
        Speices::create([
            'id'=>2,
            'speices'=>'マイスター'
        ]);
        Speices::create([
            'id'=>3,
            'speices'=>'ギガンティック'
        ]);
        Speices::create([
            'id'=>4,
            'speices'=>'ブレイバー'
        ]);
        Speices::create([
            'id'=>5,
            'speices'=>'メタルフォートレス'
        ]);
        Speices::create([
            'id'=>6,
            'speices'=>'キラーマシーン'
        ]);
    }
}
