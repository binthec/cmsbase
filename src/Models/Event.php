<?php

namespace Binthec\CmsBase\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $fillable = ['title', 'date'];

//    public $dates = ['date'];

    /**
     * バリデーションルールを返すメソッド
     *
     * @return array
     */
    static function getValidationRules()
    {
        $rules = [
            'title' => 'required',
            'date' => 'required',
        ];

        return $rules;
    }

    /**
     * 全てのイベントをfullcalendarで使える配列に整形して返すメソッド
     *
     * @return array
     */
    public static function getAllEvents()
    {
        $events = [];
        $data = self::all();
        if ($data->count()) {
            foreach ($data as $key => $val) {
                $events[$val->id] = [
                    'title' => $val->title,
                    'start' => $val->date,
                ];
            }
        }

        return $events;
    }


}
