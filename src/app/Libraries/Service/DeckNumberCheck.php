<?php

namespace App\Libraries\Service;


//デッキが50枚になっているか判断するクラス

class DeckNumberCheck{

    public function __construct(){

        $this->deck_number = 0;

    }
    /**
     * デッキ枚数を計算するメソッド
     * 
     * @param array $numbers 送信されたカード枚数の配列
     * 
     * @var int $deck_number カード総数
     * 
     * @return $deck_number
     */

    public static function check($numbers){

        $deck_number = 0;

        foreach($numbers as $number){
            $deck_number = $deck_number+$number;
        }

        return $deck_number;

    }
}