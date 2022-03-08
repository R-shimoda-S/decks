<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DeckRequest;
use Illuminate\Support\Facades\Auth;
use App\Model\Deck;
use App\Model\Card;
use App\Libraries\Domain\DeckDatabase;
use App\Libraries\Domain\CardDatabase;
use App\Libraries\Logic\DeckLogicDatabase;
use App\Libraries\Logic\CardLogicDatabase;
use App\Libraries\Service\DeckNumberCheck;
use Illuminate\Support\Facades\DB;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('decks.index');
    }

    /**
     * デッキ登録画面に遷移するメソッド
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('decks.register');
    }

    /**
     * デッキ登録
     *
     * @param  App\Http\Requests\DeckRequest  $request
     * 
     * @var int $ids カードID
     * @var int $number 枚数
     * @var string $deck デッキ名
     * @var App\Libraries\Service\DeckNumberCheck $deck_check
     * @var int $deck_number デッキ枚数
     * @var App\Libraries\Domain\DeckDatabase $deck_db
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(DeckRequest $request)
    {
        $ids = $request->id;
        $numbers = $request->number;
        $deck = $request->deck;

        //デッキ枚数の計算
        $deck_check = new DeckNumberCheck();
        $deck_number = $deck_check->check($numbers);

        //50枚以外は元の画面に戻る
        if (!($deck_number == 50)) {
            return view('decks.register');
        }

        //トランザクション処理
        DB::beginTransaction();

        try{
            //デッキ登録処理
            $deck_db = new DeckDatabase();
            $deck_db->store($deck);

            //カード登録処理
            $card_db = new CardDatabase();
            $card_db->store($ids,$numbers);
            DB::commit();

        }catch(\Exception $e) {
            DB::rollback();
        }
        
        return view('decks.index');
    }

    /**
     * デッキのカードを表示するメソッド
     *
     * @param  Deck  $deck
     * 
     * @var    App\Libraries\Logic\CardLogicDatabase $card_db
     * @var    array $cards カードリスト
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Deck $deck)
    {
        //カード名取得
        $card_db = new CardLogicDatabase();
        $cards = $card_db->load($deck); 
        return view('decks.showCard', compact('cards'));
    }

    /**
     * 修正画面を表示するメソッド
     *
     * @param  \App\Deck $decks
     * 
     * @var App\Libraries\Domain\DeckDatabase $deck_db
     * @var string $decks デッキ名
     * @var App\Libraries\Domain\CardDatabase $card_db
     * @var array $cards カード名
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Deck $deck)
    {
        //デッキ名取得
        $deck_db = new DeckLogicDatabase();
        $decks = $deck_db->getDeckName($deck);

        //カード名取得
        $card_db = new CardLogicDatabase();
        $cards = $card_db->load($deck);

        return view('decks.register', compact('decks','cards','deck'));
    }

    /**
     * デッキ更新
     *
     * @param  App\Http\Requests\DeckRequest  $request
     * @param  int $deckId デッキID
     * 
     * @var int $ids カードID
     * @var int $number 枚数
     * @var string $deck デッキ名
     * @var App\Libraries\Service\DeckNumberCheck $deck_check
     * @var int $deck_number デッキ枚数
     * @var App\Libraries\Domain\DeckDatabase $deck_db
     * @var App\Libraries\Domain\CardDatabase $card_db
     * @var App\Libraries\Logic\DeckLogicDatabase $deck_logic_db
     * @var array $decks デッキ
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(DeckRequest $request,$deckId)
    {
        $ids = $request->id;
        $numbers = $request->number;
        $deck = $request->deck;

        //デッキ枚数の計算
        $deck_check = new DeckNumberCheck();
        $deck_number = $deck_check->check($numbers);

        //50枚以外は元の画面に戻る
        if (!($deck_number == 50)) {
            return redirect()->route('decks.edit',['deck'=>$deckId]);
        }

        //トランザクション処理
        DB::beginTransaction();

        try{

            //編集前のデッキを削除する処理
            $deck_db = new DeckDatabase();
            $deck_db->destory($deckId);

            $card_db = new CardDatabase();
            $card_db->destory($deckId);
        
            //編集後デッキ登録処理
            $deck_db->store($deck);

            //編集後カード登録処理 
            $card_db->store($ids,$numbers);

            DB::commit();

        }catch(\Exception $e) {
            DB::rollback();
        
            return redirect()->route('decks.check');
        }

        return redirect()->route('decks.check');
    }

    /**
     * 削除
     *
     * @param  \App\Model\Deck $deck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deck $deck)
    {

        $this->checkUserID($deck);

        //トランザクション処理
        DB::beginTransaction();

        try{
            //削除
            $deck->delete();
            Card::where('deck_id', $deck->id)->delete();
            DB::commit();
        }catch(\Exception $e) {
            DB::rollback();
        
            return redirect()->route('decks.check');
        }

        return redirect()->route('decks.check');
    }

    /**
     * デッキ閲覧画面に転送するメソッド
     *
     * @var App\Libraries\Domain\DeckDatabase $deck_db
     * @var  Deck $decks
     * 
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
        $deck_db = new DeckLogicDatabase();
        $decks = $deck_db->load();
        return view('decks.show', compact('decks'));
    }

    /**
     * ログインユーザーIDとタスクのユーザーIDが異なる時にHttpExceotionをthrowする
     *
     * @param Deck $deck
     * @param integer $status
     * @return void
    */
    protected function checkUserID(Deck $deck, int $status =404)
    {
        //ログインIDとタスクのユーザーIDが異なる時
        if (Auth::user()->id!=$deck->user_id) {
            //HTTPレスポンスステータスコードを返却
            abort($status);
        }
    }
}
