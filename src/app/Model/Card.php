<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //Modelは単数形
    /**
     * 変更不可　要素
     *
     * @var array
     */
    protected $guarded =[
        'id',
        'card_id',
    ];


    /**
     * リレーション
     *
     *
    */
    public function deck()
    {
        return $this->belongsTo("App\Model\Deck");
    }

    /**
     * リレーション
     *
     *
    */
    public function cardList()
    {
        return $this->belongsTo("App\Model\CardList");
    }
}
