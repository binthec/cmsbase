<?php

namespace Binthec\CmsBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Binthec\Helper\Facades\Helper;

class ActivityImages extends Model
{


    /**
     * バリデーションメッセージ
     *
     * @var array
     */
    static $validationMessages = [
        //
    ];

    /**
     * モデルの「初期起動」メソッド
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        //グローバルスコープ追加。画像はいつも order の昇順にする
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    /**
     * コンストラクタ。ちゃんと親を呼び出しましょう。
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ActivityImages は Activity に属する
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * バリデーションルールを返すメソッド
     *
     * @param bool $storeFlg
     * @return array
     */
    static function getValidationRules($storeFlg = false)
    {
        $rules = [
            'name' => 'required',
        ];

        return $rules;

    }

    /**
     * 活動の様子を保存するメソッド
     *
     * @param Request $request
     */
    public function saveAll(Request $request)
    {
        //
    }


    /**
     * ディレクトリまでのパス
     *
     * @return string
     */
    public function getImageDir()
    {
        return Activity::$baseFilePath . $this->activity->image_dir;
    }

    /**
     * 無印画像のパスを返す
     *
     * @return string
     */
    public function getImagePath()
    {
        return $this->getImageDir() . '/' . $this->name;
    }

    /**
     * 写真メインタイプ用の写真のパスを返す
     *
     * @return string
     */
    public function getPhotoBaseImgPath()
    {
        return $this->getImageDir() . '/' . Activity::$pictPrefix[Activity::PHOTO_BASE] . $this->name;
    }

    /**
     * テキストメインタイプ用の写真のパスを返す
     *
     * @return string
     */
    public function getTextBaseImgPath()
    {
        return $this->getImageDir() . '/' . Activity::$pictPrefix[Activity::TEXT_BASE] . $this->name;
    }


}
