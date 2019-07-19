<?php

namespace Binthec\CmsBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Topimage extends Model
{
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
     * Dropzone.jsで上げた画像を一時的に保存するディレクトリの絶対パス
     *
     * @var string
     */
    public $tmpDir = '';

    /**
     * 一時的にファイルを保存するディレクトリのパス
     *
     * @var string
     */
    public static $tmpFilePath = '/app/public/topimage-tmp/';

    /**
     * アップロード先ディレクトリの絶対パス
     *
     * @var string
     */
    public $uploadDir = '';

    /**
     * トップ画像を格納するディレクトリパス
     *
     * @var string
     */
    public static $baseFilePath = '/files/topimage/';

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
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
        $this->tmpDir = storage_path() . self::$tmpFilePath;
        $this->uploadDir = public_path() . self::$baseFilePath;
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
     * 順番を指定するローカルスコープ
     *
     * @param $query
     * @return mixed
     */
    public function scopeOrder($query)
    {
        return $query->orderBy('order')->orderByDesc('id');
    }

    /**
     * バリデーションルールを返すメソッド
     *
     * @param bool $storeFlg
     * @return array
     */
    static function getValidationRules()
    {
        $rules = [
            'name' => 'required',
            'status' => 'required',
            'topimage' => 'required'
        ];

        return $rules;

    }

    /**
     * トップ画像を保存するメソッド
     *
     * @param Request $request
     */
    public function saveAll(Request $request)
    {
        $this->name = $request->name;
        $this->status = $request->status;
        if ($this->order === null) { //表示順がまだ無い場合は、一番後ろに持って来る
            $this->order = self::max('order') + 1;
        }

        //ファイル処理
        if ($request->topimage !== '') {

            //新規作成の場合、ディレクトリ名を新しく生成
            if ($this->image_dir === null) $this->image_dir = uniqid(rand());

            $uploadDir = $this->uploadDir . $this->image_dir . '/';
            $this->image_name = 'image' . '.' . $request->topimage->getClientOriginalExtension();

            //編集の場合、既存の画像を削除
            if ($this->id !== null) File::deleteDirectory($uploadDir, true);

            //保存先ディレクトリが無い場合は作成
            if (!File::exists($uploadDir)) File::makeDirectory($uploadDir);

            $request->file('topimage')->move($uploadDir, $this->image_name);

        }

        $this->save();

    }

    /**
     * トップ画像に紐づく画像の内、order が１の画像のパスを返すメソッド
     *
     * @return mixed
     */
    public function getImagePath()
    {
        return self::$baseFilePath . $this->image_dir . '/' . $this->image_name;
    }
}
