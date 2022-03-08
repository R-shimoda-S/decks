<?php

namespace App\Libraries\Logic;

use Illuminate\Support\Facades\DB;

//データの変更を伴わないカードテーブルの動作クラス

class CardLogicDatabase 
{
    /**
     * デッキに対応したカード取得
     *
     * @param $deck
     * @param array $cards カードリスト
     * @return array $cards
     */
    public function load($deck){

        $cards = DB::table('cards')
                ->join('card_lists','card_lists.id','=','cards.card_id')
                ->join('card_speices', 'card_speices.card_id', '=', 'card_lists.id')
                ->join('speices', 'speices.id', '=', 'card_speices.speices_id')
                ->join('colors', 'colors.id', '=', 'card_lists.color_id')
                ->where('deck_id', '=', $deck->id)->get();

        return $cards;
    }
}