<?php

namespace Binthec\CmsBase\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Validator;
use Binthec\CmsBase\Models\Activity;
use Binthec\CmsBase\Models\Picture;

class ActivityController extends Controller
{
    /**
     * １ページに表示する件数
     */
    const PAGINATION = 20;

    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $activities = Activity::paginate(self::PAGINATION);
        return view('cmsbase::backend.activity.index', compact('activities'));
    }

    /**
     * 新規作成画面表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $activity = new Activity;
        return view('cmsbase::backend.activity.edit', compact('activity'));
    }

    /**
     * 新規作成実行
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), Activity::getValidationRules(true));
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $activity = new Activity;
            $activity->saveAll($request);

            DB::commit();
            return redirect('/activity')->with('flashMsg', '登録が完了しました。');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('flashErrMsg', '登録に失敗しました。');

        }

    }

    /**
     * 編集画面表示
     *
     * @param Activity $activity
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Activity $activity)
    {
        return view('cmsbase::backend.activity.edit', compact('activity'));
    }

    /**
     * 編集実行
     *
     * @param Request $request
     * @param Activity $activity
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Activity $activity)
    {
        $validator = Validator::make($request->all(), Activity::getValidationRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $activity->saveAll($request);

            DB::commit();
            return redirect('/activity')->with('flashMsg', '登録が完了しました。');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('flashErrMsg', '登録に失敗しました。');

        }
    }

    /**
     * 削除実行
     *
     * @param Activity $activity
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Activity $activity)
    {
        if (File::exists($activity->uploadDir . $activity->id)) {
            File::deleteDirectory($activity->uploadDir . $activity->id);
        }

        $activity->delete();

        return redirect('/activity')->with('flashMsg', '削除が完了しました。');
    }

    /**
     * 表示確認
     *
     * @param Activity $activity
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Activity $activity)
    {
        //単記事以外の記事を取得
        $activities = $activity->getActList();

        return view('frontend.activity.detail', ['activities' => $activities, 'actSingle' => $activity]);
    }

    /**
     * Dropzone.jsからXHRで渡された画像を一時ディレクトリに保存するメソッド。Pictureモデルを呼び出す
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pictStore(Request $request)
    {
        return Picture::pictStore($request, Activity::class);
    }

    /**
     * Dropzone.js から削除ボタンを押された時に呼び出されるメソッド。Picureモデルを呼び出す
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pictDelete(Request $request)
    {
        return Picture::pictDelete($request, Activity::class);
    }
}
