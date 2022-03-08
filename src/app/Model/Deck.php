<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    //Modelは単数形
    /**
     * 変更不可　要素
     *
     * @var array
     */
    protected $guarded =[
        'id',
        'user_id'
    ];


    /**
     * リレーション
     *
     *
     */
    public function user()
    {
        return $this->belongsTo("App\Model\User");
    }

    public function card()
    {
        return $this->hasMany("App\Model\Card");
    }
}
