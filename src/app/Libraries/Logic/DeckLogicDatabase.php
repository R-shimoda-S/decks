<?php

namespace App\Libraries\Logic;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\Deck;

//データの変更を伴わないデッキテーブルの動作クラス

class DeckLogicDatabase{

    /**
     * デッキを検索するクラス
     *
     * @var int $userId ユーザーID
     * @var App\Model\Deck; $decks 
     * 
     * @return $decks
     */
    public static function load(){

        $userId= Auth::user()->id;
        $decks = new Deck();
        $decks = Deck::where('user_id', '=', $userId)
                ->orderBy('id', 'asc')
                ->paginate(20);

        return $decks;
    }

    /**
     * デッキ名取得メソッド
     *
     * @param  App\Model\Deck $deck
     * 
     * @param  array $decks デッキ
     * 
     * @return $decks
     */
    public function getDeckName($deck){

        $decks = DB::table('decks')->select()->where('id','=',$deck->id)->get();

        return $decks;

    }
}