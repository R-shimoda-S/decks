<?php

namespace App\Libraries\Service;


//検索する色を判断するクラス

class ColorCheck
{
    /**
     * 
     * 検索する色を判断するメソッド
     * 
     * @param array $colors 送信された色の配列
     * 
     * @return $colors
     */

     public static function color_check($colors){

        //配列が無い場合は全色検索するように設定
        if($colors == null){
            $colors = ['赤','青','白','黒','緑','無'];
        } 

        return $colors;
     }




}