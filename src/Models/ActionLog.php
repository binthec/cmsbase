<?php

namespace Binthec\CmsBase\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ActionLog extends Model
{

    /**
     * 機能名
     */
    const ACTIVITY_CONTROLLER = 'Activity';
    const EVENT_CONTROLLER = 'Event';
    const HOME_CONTROLLER = 'Home';
    const TOPIMAGE_CONTROLLER = 'Topimage';
    const USER_CONTROLLER = 'User';
    const LOGIN_CONTROLLER = 'Auth\Login';

    static $controllers = [
        self::ACTIVITY_CONTROLLER => '活動の様子',
        self::EVENT_CONTROLLER => 'カレンダー',
        self::HOME_CONTROLLER => 'ホーム',
        self::TOPIMAGE_CONTROLLER => 'トップ画像',
        self::USER_CONTROLLER => 'ユーザ管理',
        self::LOGIN_CONTROLLER => '認証',
    ];

    /**
     * 操作内容
     */
    const LOGIN = 'login';
    const LOGOUT = 'logout';
    const STORE = 'store';
    const UPDATE = 'update';
    const DESTROY = 'destroy';
    const PICT_STORE = 'pictStore';
    const PICT_DELETE = 'pictDelete';
    const ORDER_UPDATE = 'orderUpdate';
    const UPDATE_PASSWORD = 'updatePassword';

    static $actionLabels = [
        self::LOGIN => 'ログイン',
        self::LOGOUT => 'ログアウト',
        self::STORE => '新規作成',
        self::UPDATE => '編集',
        self::DESTROY => '削除',
        self::PICT_STORE => '画像新規登録',
        self::PICT_DELETE => '画像削除',
        self::ORDER_UPDATE => '表示順更新',
        self::UPDATE_PASSWORD => 'パスワード変更',
    ];

    //操作内容のラベルの色指定
    static $labelColor = [
        self::LOGIN => 'info',
        self::LOGOUT => 'info',
        self::STORE => 'success',
        self::UPDATE => 'warning',
        self::DESTROY => 'danger',
        self::PICT_STORE => 'success',
        self::PICT_DELETE => 'danger',
        self::ORDER_UPDATE => 'warning',
        self::UPDATE_PASSWORD => 'warning',
    ];

    /**
     * 検索条件のクエリを返すメソッド
     *
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getSearchQuery($data)
    {

        $query = ActionLog::query();
        $query->orderBy('created_at', 'desc'); //日付の新しい順に並べる

        //機能で検索
        if (!empty($data['controller_name'])) {
            $query->where('controller', $data['controller_name']);
        }

        //操作内容で検索
        if (!empty($data['action_name'])) {
            $query->where('action', $data['action_name']);
        }

        //ユーザIDで検索
        if (!empty($data['user_id'])) {
            $query->where('user_id', $data['user_id']);
        }

        //ログの日時で検索
        if (!empty($data['date_start'])) {
            $query->where('created_at', '>=', getStdDateTimeFromNormal($data['date_start']));
        }
        if (!empty($data['date_end'])) {
            $query->where('created_at', '<=', getStdDateTimeFromNormal($data['date_end']));
        }

        return $query;
    }

    /**
     * ユーザIDに対応するユーザ名を返すメソッド
     *
     * @return mixed|string
     */
    public function getUserName()
    {
        if ($this->user_id !== null) {
            return User::getUserNames()[$this->user_id];
        }
        return 'ー';
    }

    /**
     * 機能名を返すメソッド
     *
     * @return string
     */
    public function getControllerName()
    {
        if ($this->controller !== null) {
            return \App\ActionLog::$controllers[$this->controller];
        }
        return '-';
    }
}
