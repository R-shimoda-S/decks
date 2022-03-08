<?php

namespace App\Libraries\Domain;

use App\Model\Card;
use Illuminate\Support\Facades\DB;

//カードテーブルの動作クラス

class CardDatabase{

    /**
     * カード名登録
     *
     * @param string $decks
     *
     * @var int $deckId デッキID
     * @var App\Model\Card $card
     * 
     * @return void
     */
    public function store($ids,$numbers){

        //カード登録
        $deckId = DB::table('decks')->orderBy('id', 'desc')->first();
        for ($i=0;$i<count($ids);$i++) {
            $card = new Card();
            $card->deck_id = $deckId->id;
            $card->card_id = $ids[$i];
            $card->number = $numbers[$i];
            $card->save();
        }
    }

    /**
     * カード削除
     *
     * @param int $deckId デッキID
     * 
     * @return void
     */
    public function destory($deckId){

        Card::where('deck_id', $deckId)->delete();

    }
}