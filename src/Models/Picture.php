<?php

namespace Binthec\CmsBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Picture extends Model
{

    protected $guarded = ['id'];

    /**
     * mimeTypeを見て、拡張子を統一させる処理
     *
     * @param $file
     * @return string
     */
    public static function getPictExt($file)
    {

        $ext = 'jpg';

        switch ($file->getMimeType()) {
            case 'image/jpeg':
            case 'image/jpg':
                $ext = "jpg";
                break;

            case 'image/png':
                $ext = "png";
                break;

            case 'image/gif':
                $ext = "gif";
                break;
        }

        return $ext;
    }

    /**
     * Dropzone.jsからXHRで渡された画像を一時ディレクトリに保存するメソッド
     *
     * @param Request $request
     * @param $model
     * @return \Illuminate\Http\JsonResponse
     */
    public static function pictStore(Request $request, $model)
    {

        //画像名生成
        $fileName = $request->baseFileName . '.' . self::getPictExt($request->file($model::$paramName));

        //画像をstorageの一時ファイルに保存
//        Log::info(storage_path($model::$tmpFilePath), $fileName);

        $request->file($model::$paramName)->move(storage_path($model::$tmpFilePath), $fileName);

        return response()->json(['code' => '200', 'fileName' => $fileName]);

    }

    /**
     * Dropzone.js から削除ボタンを押された時に呼び出されるメソッド
     *
     * @param Request $request
     * @param $model
     * @return \Illuminate\Http\JsonResponse
     */
    public static function pictDelete(Request $request, $model)
    {

        switch ($request->tmpFlg) {

            case true: //一時画像の場合
                //一時ディレクトリに該当ファイルがあれば削除
                if (File::exists(storage_path($model::$tmpFilePath) . $request->fileName)) {
                    File::delete(storage_path($model::$tmpFilePath) . $request->fileName);
                    return response()->json(['code' => '200', 'msg' => '削除に成功しました。']);
                } else {
                    return response()->json(['code' => '500', 'msg' => 'ファイルが存在しないため、削除に失敗しました。']);
                }
                break;

            default:
            case false: //アップロード済画像の場合

                if (File::exists(public_path($model::$baseFilePath) . $request->actId . '/' . $request->fileName)) {
                    File::delete(public_path($model::$baseFilePath) . $request->actId . '/' . $request->fileName);
                    if (isset($model::$pictPrefix) && !empty($model::$pictPrefix)) {
                        foreach($model::$pictPrefix as $prefix){
                            File::delete(public_path($model::$baseFilePath) . $request->actId . '/' . $prefix . $request->fileName);
                        }
                    }
                    Picture::find($request->pictId)->delete();
                    return response()->json(['code' => '200', 'msg' => '削除に成功しました。']);
                } else {
                    return response()->json(['code' => '500', 'msg' => 'ファイルが存在しないため、削除に失敗しました。']);
                }
                break;
        }

    }

    /**
     * 画像単体のファイルパスを返すメソッド
     *
     * @param string $prefix
     * @return string
     */
    public function getPictPath($prefix = '')
    {
        $model = $this->target_type;

        //こっちでもうまくいくけどなぜか構文エラーでPHPStormに怒られる
//        return $this->target_type::$baseFilePath . $this->target_id . '/' . $this->name;

        return $model::$baseFilePath . $this->target_id . '/' . $prefix . $this->name;
    }

    /**
     * 画像サイズを返すメソッド
     *
     * @param string $type
     * @param string $prefix
     * @return mixed
     */
    public function getImgSize($type = 'h', $prefix = '')
    {

        list($width, $height) = getimagesize(public_path() . $this->getPictPath($prefix));

        switch ($type){
            default:
            case 'w':
                return $width;
            case 'h':
                return $height;
        }

    }

}
