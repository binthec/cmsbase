<?php

namespace Binthec\CmsBase\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Validator;
use Binthec\CmsBase\Models\Topimage;
use Binthec\CmsBase\Models\Picture;

class TopimageController extends Controller
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
        $topimages = Topimage::order()->paginate(self::PAGINATION);
        return view('cmsbase::backend.topimage.index', compact('topimages'));
    }

    /**
     * 新規作成画面表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $topimage = new Topimage;
        return view('cmsbase::backend.topimage.edit', compact('topimage'));
    }

    /**
     * 新規作成実行
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Topimage::getValidationRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

//        DB::beginTransaction();


        $topimage = new Topimage;
        $topimage->saveAll($request);


        try {



            DB::commit();
            return redirect('/topimage')->with('flashMsg', '登録が完了しました。');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('flashErrMsg', '登録に失敗しました。');

        }

    }

    /**
     * 編集画面表示
     *
     * @param Topimage $topimage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Topimage $topimage)
    {
        return view('cmsbase::backend.topimage.edit', compact('topimage'));
    }

    /**
     * 編集実行
     *
     * @param Request $request
     * @param Topimage $topimage
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Topimage $topimage)
    {
        $validator = Validator::make($request->all(), Topimage::getValidationRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $topimage->saveAll($request);

            DB::commit();
            return redirect('/topimage')->with('flashMsg', '登録が完了しました。');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('flashErrMsg', '登録に失敗しました。');

        }
    }

    /**
     * 削除実行
     *
     * @param Topimage $topimage
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Topimage $topimage)
    {
        if (File::exists($topimage->uploadDir . $topimage->image_dir)) {
            File::deleteDirectory($topimage->uploadDir . $topimage->image_dir);
        }

        $topimage->delete();

        return redirect('/topimage')->with('flashMsg', '削除が完了しました。');
    }

    /**
     * 表示順ページの表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderEdit()
    {
        $topimages = Topimage::order()->get();
        return view('cmsbase::Backend.topimage.order', compact('topimages'));
    }

    /**
     * 表示順編集実行
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function orderUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pictures' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            foreach ($request->pictures as $key => $id) {
                Topimage::where('id', $id)->update(['order' => $key + 1]);
            }

            DB::commit();
            return redirect('topimage')->with('flashMsg', '変更が完了しました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('topimage')->with('flashErrMsg', '変更に失敗しました。');
        }

    }

}