@extends('cmsbase::backend.layouts.app')
@section('bodyId', 'order-edit')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>トップ画像表示順設定</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> ドラッグ＆ドロップでトップ画像の表示順を設定します。
            </p>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('topimage.index') }}">トップ画像一覧</a></li>
                <li class="active">トップ画像表示順設定</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">

                        {!! Form::open(['method' => 'POST', 'route' => 'topimage.order.update']) !!}

                        <div class="box-header with-border text-right">
                            {!! Form::submit('決&emsp;定', ['class' => 'btn btn-primary']) !!}
                        </div>

                        <div class="box-body">
                            @if($topimages->count())

                                <ul id="topimages" class="box-body">
                                    @foreach($topimages as $img)
                                        <li class="list">
                                            <img src="{{ $img->getPictPath() }}">
                                            {!! Form::hidden('pictures[]', $img->id) !!}
                                        </li>
                                    @endforeach
                                </ul><!-- /.box-body -->

                            @else
                                トップ画像がありません。
                            @endif
                        </div>

                        {!! Form::close() !!}

                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>

    </div><!-- ./content-wrapper -->
@endsection

@section('js')
    <script>
        $(function () {
            /**
             *  jQueryUI sortable
             */
            $("#topimages").sortable({
                cursor: 'move',
                opacity: 0.7,
                placeholder: 'highlight',
                start: function(event, ui){
                    ui.item.toggleClass("highlight");
                    ui.placeholder.width(ui.item.width());
                    ui.placeholder.height(ui.item.height());
                },
                stop: function (event, ui) {
                    ui.item.toggleClass("highlight");
                },
            });
            $("#topimages").disableSelection();
        });
    </script>
@endsection