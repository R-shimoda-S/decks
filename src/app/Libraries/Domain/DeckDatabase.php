<?php

namespace App\Libraries\Domain;

use Illuminate\Support\Facades\Auth;
use App\Model\Deck;

//デッキテーブルの動作クラス

class DeckDatabase{

    /**
     * デッキ名登録
     *
     * @param string $decks
     * 
     * @var App\Model\Deck $deck
     * 
     * @return void
     */
    public function store($decks){

        $deck = new Deck();
        $deck->name = $decks;

        //デッキ名登録
        $deck->user_id = Auth::user()->id;
        $deck->save();    
    }

    /**
     * デッキ削除
     *
     * @param int $deckId デッキID
     * 
     * @return void
     */
    public function destory($deckId){

        Deck::where('id', $deckId)->delete();

    }
}