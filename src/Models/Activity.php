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
use Binthec\CmsBase\Models\ActivityImages;

class Activity extends Model
{

    /**
     * ソフトデリートを使う
     */
    use SoftDeletes;

    /**
     * １ページに表示する数
     */
    const ACT_NUM_LIST = 20;
    const ACT_NUM_DETAIL = 5;

    /**
     * ステータス
     */
    const OPEN = 1;
    const CLOSE = 99;

    static $statusList = [
        self::OPEN => '公　開',
        self::CLOSE => '非公開',
    ];

    /**
     * 記事タイプ
     */
    const PHOTO_BASE = 1;
    const TEXT_BASE = 2;

    static $typeList = [
        self::PHOTO_BASE => '写真メインの記事',
        self::TEXT_BASE => 'テキストメインの記事',
    ];

    //短い名前バージョン
    static $typeListShort = [
        self::PHOTO_BASE => '写真',
        self::TEXT_BASE => 'テキスト',
    ];

    static $typePrefix = [
        self::PHOTO_BASE => 'photo',
        self::TEXT_BASE => 'text',
    ];

    /**
     * 詳細ページで使う画像のプレフィックス
     *
     * @var string
     */
    static $pictPrefix = [
        self::PHOTO_BASE => 'w270_',
        self::TEXT_BASE => '270x180_',
    ];

    /**
     * アップロード先ディレクトリの絶対パス
     *
     * @var string
     */
    public $uploadDir = '';

    /**
     * 活動の様子に使う画像を格納するディレクトリパス
     *
     * @var string
     */
    public static $baseFilePath = '/files/activity/';

    /**
     * 画像アップロードの際のkey名
     *
     * @var string
     */
    public static $paramName = 'file';

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

        //グローバルスコープ追加。活動の様子は基本的に開催日の新しい順に並べる
        static::addGlobalScope('date', function (Builder $builder) {
            $builder->orderBy('date', 'desc');
        });
    }

    /**
     * コンストラクタ。ちゃんと親を呼び出しましょう。
     */
    public function __construct()
    {
        parent::__construct();
        $this->uploadDir = public_path() . self::$baseFilePath;
    }

    /**
     * 画像のリレーション。1対多＝Activity:ActivityImages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activityImages()
    {
        return $this->hasMany(ActivityImages::class);
    }

    /**
     * 公開ステータスのものだけ取得する場合のローカルスコープ
     *
     * @param $query
     * @return mixed
     */
    public function scopeOpen($query)
    {
        return $query->where('status', self::OPEN);
    }

    /**
     * timetable カラム用のアクセサ
     * timetable の値を取ってくる時に、自動的にアンシリアライズする
     *
     * @param $value
     * @return mixed
     */
    public function getTimetableAttribute($value)
    {
        return unserialize($value);
    }

    /**
     * timetable カラム用のミューテタ
     * timetable に値がセットされる際に自動的にシリアライズする
     *
     * @param $value
     */
    public function setTimetableAttribute($value)
    {
        $this->attributes['timetable'] = serialize($value);
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
            'title' => 'required',
            'date' => 'required',
            'place' => 'required',
            'type' => 'required',
            'status' => 'required',
        ];

        if ($storeFlg === true) {
            $rules = array_merge($rules, ['images' => 'required']);
        }

        return $rules;

    }

    /**
     * 活動の様子を保存するメソッド
     *
     * @param Request $request
     */
    public function saveAll(Request $request)
    {
        $this->title = ($request->title !== null) ? $request->title : null;
        $this->date = Helper::getStdDate($request->date); //必須項目
        $this->place = $request->place; //必須項目
        $this->detail = ($request->detail !== null) ? $request->detail : null;
        $this->type = $request->type; //必須項目
        $this->status = $request->status; //必須項目

        $timetable = [];
        foreach ($request->time as $key => $time) {
            //値が入ってる場合のみ保存
            if ($request->time[$key] !== null && $request->action[$key] !== null) {
                $timetable[$key]['time'] = $time;
                $timetable[$key]['action'] = $request->action[$key];
            }
        }

        $this->timetable = !empty($timetable) ? $timetable : null;

        //新規作成の場合、ディレクトリ名を新しく生成
        if ($this->image_dir === null) $this->image_dir = uniqid(rand());

        $this->save();

        //画像が設定されている場合は保存処理
        if (!empty($request->images)) {

            $uploadDir = $this->uploadDir . $this->image_dir . '/';

            //保存先ディレクトリが無い場合は作成
            if (!File::exists($uploadDir)) File::makeDirectory($uploadDir);

            //編集の場合、既存の画像を削除
//            if ($this->id !== null) File::deleteDirectory($uploadDir, true);

            //それぞれの画像に対して処理
            $num = 1;
            foreach ($request->file('images') as $img) {

                $image = new ActivityImages();
                $image->activity_id = $this->id;
                $image->name = 'image' . $num . '.' . $img->getClientOriginalExtension();
                $image->order = $num;

                //画像を移動
                $img->move($uploadDir, $image->name);

                /**
                 * リサイズ処理
                 */
                //写真ベース用
                Image::make($uploadDir . $image->name)->resize(270, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($uploadDir . self::$pictPrefix[self::PHOTO_BASE] . $image->name);

                //テキストベース用
                Image::make($uploadDir . $image->name)->fit(270, 180)->save($uploadDir . self::$pictPrefix[self::TEXT_BASE] . $image->name);

                $image->save();
                $num++;

            }

        }


    }

    /**
     * 画像の内、order が１の画像のパスを返すメソッド
     *
     * @return string
     */
    public function getMainPictPath()
    {

        if ($this->activityImages->count() > 0) {
            return self::$baseFilePath . $this->image_dir . '/' . self::$pictPrefix[self::TEXT_BASE] . $this->activityImages->sortBy('order')->first()->name;
        }

        return '';

    }

    /**
     * 詳細画面で表示する、「自分以外の、公開中の」活動の様子を取得して返すメソッド
     *
     * @return mixed
     */
    public function getActList()
    {

        return self::where('id', '!=', $this->id)
            ->open()
            ->take(self::ACT_NUM_DETAIL)
            ->get();

    }

}
