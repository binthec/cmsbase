<?php

namespace Binthec\CmsBase\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActionLog;
use App\User;

class ActionLogController extends Controller
{

    /**
     * １ページに表示させる件数
     */
    const PAGINATION = 50;

    /**
     * 一覧画面表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $query = ActionLog::getSearchQuery($request->input());
        $logs = $query->paginate(self::PAGINATION);

        return view('backend.actionLog.index', compact('logs'))
            ->with($request->input());

    }
}
