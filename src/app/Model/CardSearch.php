<?php

namespace App\Model;

class CardSearch{

    public function __construct(){
        
    }

    public function search($cardLists,$name){

        $list = [];

        foreach($cardLists as $cardList){
            if(preg_match("/$name/",$cardList['name']) == true){
                array_push($list,$cardList);
            }
        }

    return $list;
    }

}