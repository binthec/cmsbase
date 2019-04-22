@extends('cmsbase::backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>カレンダー</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> 左のフォームから追加するか、カレンダーの日付欄をクリックしても予定を追加出来ます。
            </p>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">カレンダー</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-3">

                    <div class="box box-solid">
                        <div class="box-header with-border bg-primary">
                            <h3 class="box-title">予定を追加</h3>
                        </div>
                        <div class="box-body">
                            {!! Form::open(['method' => 'POST', 'route' => 'event.store']) !!}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="タイトル">
                            </div>
                            <div class="form-group">
                                <input type="text" name="date" class="form-control use-datepicker" placeholder="日付">
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-flat">追加</button>
                            </div>

                            {!! Form::close() !!}
                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div><!-- /.col -->

                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- 日程追加用modal -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        「<span id="add-date"></span>」に予定を追加する
                    </h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'POST', 'route' => 'event.store', 'id' => 'add-form']) !!}
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="タイトル">
                        <input type="hidden" name="date">
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        &emsp;
                        <button type="submit" class="btn btn-primary btn-flat">追&emsp;加</button>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.modal-body -->

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- 日程編集用modal -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        日程「<span id="school-title"></span>」を 編集 or 削除 する
                    </h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['method' => 'PUT', 'url' => '', 'id' => 'update-form']) !!}
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="タイトル">
                    </div>
                    <div class="form-group">
                        <input type="text" name="date" class="form-control use-datepicker" placeholder="日付">
                    </div>

                    <button type="submit" class="btn btn-success btn-flat pull-right">編集実行</button>
                    {!! Form::close() !!}

                    <div class="clearfix">
                        {!! Form::open(['method' => 'DELETE', 'url' => '', 'id' => 'destroy-form']) !!}
                        <button type="submit" class="btn btn-danger pull-left">削&emsp;除</button>
                        {!! Form::close() !!}

                        <div class="pull-right">
                            &emsp;&emsp;
                        </div>

                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">キャンセル</button>
                    </div>

                </div><!-- /.modal-body -->

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    <script>
        $(function () {
            var calendar = $('#calendar').fullCalendar({

                //基本設定
                header: getCalendarHeaderTools(),
                views: {
                    listYear: {buttonText: '1年の予定'}
                },
                noEventsMessage: '予定がありません。',

                //初期表示の月
                @if (Session::has('editedDate'))
                //編集後に遷移してきた場合は、初期表示月を編集した月にする
                defaultDate: '{{ Session::get('editedDate') }}',
                @endif

                //イベントを回して出力
                events: [
                        @foreach($events as $id => $event)
                    {
                        id: "{{ $id }}",
                        title: "{{ $event['title'] }}",
                        start: "{{ $event['start'] }}",
                    },
                    @endforeach
                ],

                //日付欄をクリックした時
                dayClick: function (date, jsEvent, view, resourceObj) {
                    var myModal = $('#modal-add').modal();
                    $('#modal-add').find('#add-date').text(date.format('YYYY年MM月DD日'));
                    $('#modal-add').find('input[name=date]').val(date.format('YYYY/MM/DD'));
                },
                //イベントのラベルをクリックした時
                eventClick: function (calEvent, jsEvent, view) {
                    var myModal = $('#modal-edit').modal();
                    $('#modal-edit').find('#school-title').text(calEvent.title);
                    $('#modal-edit').find('#update-form, #destroy-form').attr('action', '/event/' + calEvent.id);
                    $('#modal-edit').find('input[name=title]').val(calEvent.title);
                    $('#modal-edit').find('input[name=date]').val(calEvent.start.format('YYYY/MM/DD'));
                }
            });
        });
    </script>
@endsection