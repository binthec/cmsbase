@extends('cmsbase::backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/vendor/lity/lity.min.css">
@endsection

@section('js')
    <script src="/vendor/lity/lity.min.js"></script>
@endsection

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>活動の様子一覧</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> 「活動の様子」一覧です。
            </p>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">活動の様子一覧</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border text-right">
                            <a class="btn btn-primary" href="{{ route('activity.create') }}">新規作成</a>
                        </div>

                        <div class="box-body">

                        @if($activities->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-primary text-center">
                                    <th width="8%">ステータス</th>
                                    <th width="10%">タイプ</th>
                                    <th width="10%">開催日</th>
                                    <th>タイトル</th>
                                    <th width="10%">開催場所</th>
                                    <th width="5%">表示確認</th>
                                    <th width="5%">編集</th>
                                    <th width="5%">削除</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($activities as $act)
                                    <tr class="text-center">
                                        <td>
                                            <label class="label label-lg {{ ($act->status === 1)? 'label-info' : 'label-danger' }}">
                                                {{ \Binthec\CmsBase\Models\Activity::$statusList[$act->status] }}
                                            </label>
                                        </td>
                                        <td>{{ \Binthec\CmsBase\Models\Activity::$typeListShort[$act->type] }}</td>
                                        <td>{{ Helper::getJaDate($act->date) }}</td>
                                        <td class="text-left">{{ $act->title }}</td>
                                        <td>{{ $act->place }}</td>
                                        <td><a class="btn btn-success" href="{{ route('activity.confirm', $act->id) }}" target="_blank"><i class="fa fa-external-link"></i> 表示確認</a></td>
                                        <td><a class="btn btn-primary" href="{{ route('activity.edit', $act->id) }}">編集</a></td>
                                        <td>
                                            <a class="btn btn-danger" data-toggle="modal" data-target="#destroy{{ $act->id }}">削除</a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="destroy{{ $act->id }}" tabindex="-1" role="dialog" aria-labelledby="modal">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel">削除実行してよろしいですか？</h4>
                                                        </div>
                                                        <div class="modal-body clearfix">
                                                            <div>
                                                                <p><i class="fa fa-image"></i> 選択したトップ画像：「{{ $act->name }}」</p>
                                                            </div>
                                                            <div class="help-block pull-right">
                                                                <p class="text-danger"><i class="fa fa-warning"></i>この処理は取り消せません。</p>
                                                            </div>
                                                        </div>
                                                        {!! Form::open(['method' => 'delete', 'route' => ['activity.destroy', $act->id]]) !!}
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary-outline" data-dismiss="modal">キャンセル</button>
                                                            <button type="submit" class="btn btn-danger">削除実行</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div><!-- /.modal -->
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <i class="fa fa-warning"></i> 活動の様子が存在しません。
                        @endif

                        </div><!-- /.box-body -->

                        @if($activities->count() > 0)
                            <div class="box-footer text-center">
                                {{ $activities->links() }}
                            </div>
                        @endif

                    </div><!-- /.box -->

                </div><!-- /.col -->
            </div><!-- /.row -->

        </section>

    </div><!-- ./content-wrapper -->
@endsection
