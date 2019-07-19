@extends('cmsbase::backend.layouts.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Dashboard
                <small>フロントの機能いろいろ</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <!-- Left Column -->
                <section class="col-lg-5">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-image"></i> トップ画像</h3>
                            <a class="btn btn-primary pull-right" href="{{ route('topimage.index') }}">トップ画像一覧</a>
                        </div>

                        <div class="box-body">

                            <div class="top-slider">
                                @foreach($topimages as $img)
                                    <div><img src="{{ $img->getImagePath() }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div><!-- /.box -->

                    <div class="box box-solid" id="act-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-newspaper-o"></i> 活動の様子</h3>
                            <a class="btn btn-primary pull-right" href="{{ route('activity.index') }}">活動の様子一覧</a>
                        </div>

                        <div class="box-body">
                            @include('cmsbase::frontend.activity.small-list')
                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </section><!-- right col -->


                <!-- Right Column -->
                <section class="col-lg-7">
                    <!-- カレンダー -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-calendar"></i>
                            <h3 class="box-title">カレンダー</h3>
                            <a class="btn btn-primary pull-right" href="{{ route('event.index') }}">カレンダー編集</a>
                        </div>

                        <div class="box-body">
                            <div id="calendar"></div>
                        </div>

                        <div class="box-footer">
                        </div>
                    </div><!-- /.box -->
                </section><!-- /.Left col -->


            </div><!-- /.row (main row) -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection

@section('css')
    @include('cmsbase::common.top-css')
@endsection

@section('js')
    @include('cmsbase::common.top-js')
@endsection
