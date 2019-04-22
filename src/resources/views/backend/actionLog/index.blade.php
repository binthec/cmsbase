@extends('cmsbase::backend.layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>アクションログ</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> 管理画面でログインや新規登録などの操作をした履歴を確認出来ます。
            </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    {!! Form::open(['method' => 'GET', 'route' => 'actionlog.index', 'class' => 'form-horizontal']) !!}

                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <div class="box-title"><i class="fa fa-search"></i> 検索</div>
                        </div>

                        <div class="box-body">

                            <div class="form-group">
                                <label for="controller-name" class="col-sm-2 control-label">機能名</label>
                                <div class="col-sm-4">
                                    {!! Form::select('controller_name', \App\ActionLog::$controllers, null,['class' => 'form-control use-select2', 'placeholder' => '選択してください']) !!}
                                </div>

                                <label for="action-name" class="col-sm-2 control-label">操作内容</label>
                                <div class="col-sm-4">
                                    {!! Form::select('action_name', \App\ActionLog::$actionLabels, null,['class' => 'form-control use-select2', 'placeholder' => '選択してください']) !!}
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <label for="user-id" class="col-sm-2 control-label">操作したユーザ</label>
                                <div class="col-sm-4">
                                    {!! Form::select('user_id', \App\User::getUserNames(), null, ['class' => 'form-control use-select2', 'placeholder' => '選択してください']) !!}
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('date_start') || $errors->has('date_end') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">操作日時</label>
                                <div class="col-sm-10 form-inline">
                                    {!! Form::text('date_start', '', ['id' => 'date_start', 'class' => 'form-control use-datetimepicker']) !!}
                                    〜
                                    {!! Form::text('date_end', old('date_end'), ['id' => 'date_end', 'class' => 'form-control use-datetimepicker']) !!}
                                </div>
                            </div><!-- form-group -->

                        </div><!-- /.box-body -->

                        <div class="box-footer text-center">
                            <a href="{{ route('actionlog.index') }}" class="btn btn-warning">リセット</a>&emsp;
                            {!! Form::submit('検　　索',['class' => 'btn btn-primary']) !!}

                        </div>

                    </div><!-- /.box -->

                    {!! Form::close() !!}

                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-body">

                            @if($logs->count() > 0)
                                <table class="table table-bordered with-btn-sm">
                                    <thead>
                                    <tr class="bg-primary text-center">
                                        <th>操作日時</th>
                                        <th>操作したユーザ</th>
                                        <th>機能名</th>
                                        <th>操作内容</th>
                                        <th>詳細表示</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($logs as $log)
                                        <tr class="text-center">
                                            <td>{{ $log->created_at }}</td>
                                            <td>{{ $log->getUserName() }}</td>
                                            <td>{{ $log->getControllerName() }}</td>

                                            <td class="text-center">
                                                <label class="label label-lg label-{{ \App\ActionLog::$labelColor[$log->action] }}">
                                                    {{ \App\ActionLog::$actionLabels[$log->action] }}
                                                </label>
                                            </td>
                                            <td>
                                                @php
                                                    $detail = json_decode($log->request, true);
                                                @endphp

                                                @if(!empty($detail))
                                                    <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-default-{{$log->id}}">詳細</a>
                                                @else
                                                    ー
                                                @endif
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-default-{{$log->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">アクションログ詳細</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <dl class="dl-horizontal">
                                                            <dt>操作日時</dt>
                                                            <dd>{{ $log->created_at }}</dd>
                                                            <dt>操作したユーザ</dt>
                                                            <dd>{{ $log->getUserName() }}</dd>
                                                            <dt>機能名</dt>
                                                            <dd>{{ $log->getControllerName() }}</dd>

                                                            <dt>操作区分</dt>
                                                            <dd>
                                                                <label class="label label-{{ \App\ActionLog::$labelColor[$log->action] }}">
                                                                    {{ \App\ActionLog::$actionLabels[$log->action] }}
                                                                </label>
                                                            </dd>

                                                            @if(!empty($detail))
                                                                <hr>
                                                                @foreach($detail as $key => $data)
                                                                    <dt>{{ $key }}</dt>
                                                                    <dd>
                                                                        @if(is_array($data))
                                                                            @foreach($data as $k => $d)
                                                                                {{ $d }}<br>
                                                                            @endforeach
                                                                        @else
                                                                            {{ $data }}
                                                                        @endif
                                                                    </dd>
                                                                @endforeach
                                                            @endif
                                                        </dl>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">閉じる</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <i class="fa fa-warning"></i> ログが存在しません。
                            @endif

                            <div class="card-footer text-center">
                                {{ $logs->links() }}
                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </section>
    </div><!-- /.content-wrapper -->

@endsection

@section('js')
    <script>
        $(function () {
            $('#date_start').datetimepicker();
            $('#date_end').datetimepicker({
                useCurrent: false,
            });
            $("#date_start").on("dp.change", function (e) {
                $('#date_end').data("DateTimePicker").minDate(e.date);
            });
            $("#date_end").on("dp.change", function (e) {
                $('#date_start').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
@endsection