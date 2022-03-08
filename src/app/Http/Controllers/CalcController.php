<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CalcRequest;
use App\Libraries\Service\DrowCalc;

class CalcController extends Controller
{
    /**
     * 確率計算のページに移行するメソッド
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('decks.calc');
    }

    /**
     * 確率計算の表示
     * @param  App\Http\Requests\CalcRequest $request
     * 
     * @param  int $mulligan　確率
     * @param  array $missProbabilities 引けない確率を格納する配列
     * @param  int $missProbability 引けない確率
     * @param  App\Libraries\Service\DrowCalc $calc
     * @param  array $answers 引ける確率
     * 
     * @return \Illuminate\Http\Response
     */
    public function calc(CalcRequest $request)
    {
        //引く枚数がデッキ枚数より多い場合、戻る
        if ($request->number<$request->card) {
            return redirect()->route('decks.mulligan');
        }
        
        $mulligan = null;
        $missProbabilities = array();

        $calc = new DrowCalc();
        //マリガン有分岐
        if ($request->mulligan === "2") {
            $mulligan = $calc->mulligan($request);
        }
        //先行・後攻を判別
        if ($request->pro === "2") {
            $request->draw = $request->draw + 2;
        }

        //ドロー枚数がデッキ枚数より多いかどうかの判定
        if ($request->number<$request->draw) {
            return redirect()->route('decks.mulligan');
        }

        //確率計算
        for ($i=0;$i<5;$i++) {
            $missProbability = $calc->calc($request);
            $missProbabilities[] = $missProbability;
            $request->draw = $request->draw + 2;
            if ($request->number<$request->draw) {
                break;
            }
        }
        $answers = $calc->keyCardGet($missProbabilities, $mulligan);
        return view('decks.calc', compact('answers'));
    }
      
}
