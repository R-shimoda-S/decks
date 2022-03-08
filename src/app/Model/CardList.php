<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CardList extends Model
{
    //Modelは単数形
    /**
     * 変更不可　要素
     *
     * @var array
     */
    protected $guarded =[
        'id',
        'color_id'
    ];

    /**
     * リレーション
     *
     *
    */
    public function speices()
    {
        return $this->belongsToMany("App\Model\Speices");
    }

    /**
     * リレーション
     *
     *
    */
    public function card()
    {
        return $this->hasMany("App\Model\Card");
    }
}
