<?php

namespace App\Libraries\Logic;

use Illuminate\Support\Facades\DB;
use App\Model\CardList;

//カードリストテーブルの動作クラス

class CardListDatabase 
{
    /**
     * 名前検索するメソッド
     */

    public function searchName($name){

        $list = DB::table('card_lists')
            ->join('card_speices', 'card_speices.card_id', '=', 'card_lists.id')
            ->join('speices', 'speices.id', '=', 'card_speices.speices_id')
            ->join('colors', 'colors.id', '=', 'card_lists.color_id')
            ->select('card_lists.id','card_lists.name','card_lists.cost','card_lists.text','card_lists.power','colors.color','speices.speices')
            ->where('name', 'like', "%$name%")
            ->orderBy('card_lists.id', 'asc')
            ->orderBy('card_lists.pack_id', 'asc')
            ->paginate(15);

        return $list;
    }

    /**
      * 詳細検索するメソッド
      *
      * @param string $name カード名
      * @param int $pack_id 収録弾ID
      * @param string color 色
      * @param int $cost_min 最小コスト
      * @param int $cost_max 最大コスト
      * @param int $power_min 最小パワー
      * @param int $power_max 最大パワー
      *
      * @var array $list 検索リスト
      *
      * @return $list
      */
      public function search($name,$pack_id,$color,$cost_min,$cost_max,$power_min,$power_max){

        $list = DB::table('card_lists')
            ->join('card_speices', 'card_speices.card_id', '=', 'card_lists.id')
            ->join('speices', 'speices.id', '=', 'card_speices.speices_id')
            ->join('colors', 'colors.id', '=', 'card_lists.color_id')
            ->select('card_lists.id','card_lists.name','card_lists.cost','card_lists.text','card_lists.power','colors.color','speices.speices')
            ->where('name', 'like', "%$name%")
            ->where('pack_id', 'like', "%$pack_id%")
            ->whereIn('colors.color',$color)
            ->whereBetween('cost', [$cost_min,$cost_max])
            ->whereBetween('power', [$power_min,$power_max])
            ->orderBy('card_lists.id', 'asc')
            ->orderBy('card_lists.pack_id', 'asc')
            ->paginate(15);

        return $list;
    }

}