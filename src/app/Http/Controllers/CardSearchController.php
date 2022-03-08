<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CardSearch;
use App\Libraries\Logic\CardListDatabase;
use App\Libraries\Service\ColorCheck;

class CardSearchController extends Controller
{

    /**
      * 検索画面に遷移するメソッド
      *
      * @var App\Libraries\Logic\CardListDatabase $cardlist_db
      * @var array $list 検索リスト 
      *
      * @return \Illuminate\Http\Response
      */
      public function index(){

        if(!($_GET["search"] == null)){
          //入力があった場合は名前検索を行う
          $cardlist_db = new CardListDatabase();
          $lists = $cardlist_db->searchName($_GET["search"]);
          return view('search.index', compact('lists'));
        }else{
          return view('search.index');
        }

    }

      /**
       * カード検索
       * 
       *
       * @param Request $request
       * 
       * @var string $name カード名
       * @var int $pacuNumber 収録弾
       * @var array $colors　色
       * @var int $cost_min 最小コスト
       * @var int $cost_max 最大コスト
       * @var int $power_min 最小パワー
       * @var int $power_max 最大パワー
       * @var App\Libraries\Service\ColorCheck $color_check 
       * @var App\Libraries\Logic\CardListDatabase $cardlist_db
       * @var array $list 検索リスト
       * 
       * @return \Illuminate\Http\Response
       */
      public function search(Request $request){

        //リクエストの取得
        $name = $request->name;
        $packNumber = $request->pack_number;
        $colors = $request->color;
        $cost_min =$request->cost_min;
        $cost_max =$request->cost_max;
        $power_min =$request->power_min;
        $power_max =$request->power_max;

        //検索する色の判別
        $color_check = new ColorCheck();
        $colors = $color_check->color_check($colors);
        
        //検索
        $cardlist_db = new CardListDatabase();
        $lists = $cardlist_db->search($name,$packNumber,$colors,$cost_min,$cost_max,$power_min,$power_max);

        return view('search.index', compact('lists'));

      }
}
