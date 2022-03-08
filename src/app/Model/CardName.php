<?php

namespace App\Model;

class CardName{

    public function __construct($list){

        $this->list =[
            $this->name = $list->name,
            $this->cost = $list->cost,
            $this->color = $list->color,
            $this->power = $list->power,
            $this->species = $list->species
        ];
    }

    public function getList()
    {
        return $this->list;
    }
}
    
    
    
    ?>