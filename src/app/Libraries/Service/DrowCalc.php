<?php

namespace App\Libraries\Service;

use App\Http\Requests\CalcRequest;

//ドローの確率を計算する

class DrowCalc{

    /**
     * マリガンした場合の不要なカードを引く確率計算
     * @param App\Http\Requests\CalcRequest $request
     *
     * @var  int $way　デッキ全体のカードを引く通り
     * @var  int $missWay 不要なカードを引く通り
     * @var  int $missCard　不要なカードの枚数
     * @var  int $missProbabilit 不要なカードを引く確率
     *
     * @return int $missProbability
     */
    public function mulligan(CalcRequest $request)
    {
        $way = 1;
        //デッキ全体のカードを引く通りを求める
        //　確率計算分子部分の計算式
        for ($i=0;$i<$request->draw;$i++) {
            $way = $way*($request->number-$i);
        }
        //　確率計算分母部分の計算式
        for ($i=1;$i<=$request->draw;$i++) {
            $way = $way/$i;
        }
    
        //欲しいカード以外を引く通り
        $missWay = 1;
        $missCard = $request->number-$request->card;
        //　確率計算分子部分の計算式
        for ($i=0;$i<$request->draw;$i++) {
            $missWay = $missWay*($missCard-$i);
        }
        //　確率計算分母部分の計算式
        for ($i=1;$i<=$request->draw;$i++) {
            $missWay = $missWay/$i;
        }
        //欲しいカードが引けていない確率を求める計算式
        $missProbability = $missWay/$way;
        return $missProbability;
    }

    /**
     * 不要なカードを引く確率計算
     * @param App\Http\Requests\CalcRequest $request
     *
     * @var  int $way　デッキ全体のカードを引く通り
     * @var  int $missWay 不要なカードを引く通り
     * @var  int $missCard　不要なカードの枚数
     * @var  int $missProbabilit 不要なカードを引く確率
     *
     * @return int $missProbability
     */
    public function calc(CalcRequest $request)
    {
        $way = 1;
        //デッキ全体のカードを引く通りを求める
        //　確率計算分子部分の計算式
        for ($i=0;$i<$request->draw;$i++) {
            $way = $way*($request->number-$i);
        }
        //　確率計算分母部分の計算式
        for ($i=1;$i<=$request->draw;$i++) {
            $way = $way/$i;
        }

        //欲しいカード以外を引く通り
        $missWay = 1;
        $missCard = $request->number-$request->card;
        //　確率計算分子部分の計算式
        for ($i=0;$i<$request->draw;$i++) {
            $missWay = $missWay*($missCard-$i);
        }
        //　確率計算分母部分の計算式
        for ($i=1;$i<=$request->draw;$i++) {
            $missWay = $missWay/$i;
        }
        //欲しいカードが引けていない確率を求める計算式
        $missProbability = $missWay/$way;
        return $missProbability;
    }

    /**
     * ⒳ターン目にキーカードが手札に来る確率計算
     * @param  array $missProbabilities　引けない確率
     * @param  int $mulligan マリガンした場合の引けない確率
     *
     * @var  int $answer キーカードを引く確率
     * @var  string $textAnswer 
     * @var  array $answers キーカードを引く確率を格納する配列
     *
     * @return array $answers
     */
    public function keyCardGet($missProbabilities, $mulligan)
    {
        for ($i=0;$i<count($missProbabilities);$i++) {
            $missAll=1;
            if (isset($mulligan)) {
                $missAll = $missAll*$mulligan;
            }
        
            $missAll = $missAll*$missProbabilities[$i];
            $answer = (1-$missAll)*100;
            $textAnswer = $answer;
            $answers[] = $textAnswer;
        }
        return $answers;
    }

}