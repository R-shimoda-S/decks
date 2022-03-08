<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Speices extends Model
{
    //Modelは単数形
    /**
    * 変更不可　要素
    *
    * @var array
    */
    protected $guarded =[
        'id',
    ];

    /**
     * リレーション
     *
     *
     */
    public function cardLists()
    {
        return $this->belongsToMany("App\Model\CardList");
    }
}
