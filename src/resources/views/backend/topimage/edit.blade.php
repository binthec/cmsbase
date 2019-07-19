@extends('cmsbase::backend.layouts.app')
@section('bodyId', 'topimage-edit')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>トップ画像を{{ ($topimage->id === null)? '新規登録' : '編集' }}</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> トップページのスライダーに表示する画像を{{ ($topimage->id === null)? '新規登録' : '編集' }}します。
            </p>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('topimage.index') }}">トップ画像一覧</a></li>
                <li class="active">トップ画像を{{ ($topimage->id === null)? '新規登録' : '編集' }}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    @if($topimage->id === null)
                        {!! Form::open(['method' => 'post', 'route' => 'topimage.store','enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'put', 'route' => ['topimage.update', $topimage],'enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                    @endif
                    {{ csrf_field() }}

                    <div class="box box-info">

                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-edit"></i> 入力してください </h3>
                        </div>
                        <div class="box-body">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">名前 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('name', ($topimage->id !== null)? $topimage->name: '', ['id' => 'name', 'class' => 'form-control', 'required']) }}
                                    @if($errors->has('name'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('name') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">

                                <label for="topimage" class="col-sm-3 control-label">公開ステータス <span class="text-danger">*</span></label>
                                <div class="col-sm-9">

                                    <label class="radio-inline">
                                        @if($topimage->id !== null && $topimage->status === \Binthec\CmsBase\Models\Topimage::OPEN)
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Topimage::OPEN, true, ['class' => 'flat-blue']) }} 公開
                                        @else
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Topimage::OPEN, '', ['class' => 'flat-blue']) }} 公開
                                        @endif
                                    </label>
                                    <label class="radio-inline">
                                        @if($topimage->id === null || $topimage->status === \Binthec\CmsBase\Models\Topimage::CLOSE)
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Topimage::CLOSE, true, ['class' => 'flat-blue']) }} 非公開
                                        @else
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Topimage::CLOSE, '', ['class' => 'flat-blue']) }} 非公開
                                        @endif
                                    </label>

                                    @if($errors->has('status'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('status') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <hr>

                            <div class="form-group{{ $errors->has('topimage') ? ' has-error' : '' }}">
                                <label for="act-pict-tmp" class="col-sm-3 control-label">画像 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::file('topimage', ['id' => 'topimage', 'required']) }}
                                    @if($topimage->id !== null)
                                        <div class="">
                                            <img src="{{ $topimage->getImagePath() }}">
                                        </div>
                                    @endif

                                    <span class="help-block">
                                        <p class="text-warning">※高さ600px以上の画像推奨</p>
                                        <p class="text-warning">※ファイルを新たにアップロードした場合、既存の画像は破棄されます</p>
                                        @if($errors->has('topimage'))
                                            <strong class="text-danger">{{ $errors->first('topimage') }}</strong>
                                        @endif
                                    </span>

                                </div><!-- /.col-sm-9 -->
                            </div><!-- form-group -->

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">登　録</button>
                            </div>
                        </div><!-- /.box-footer -->

                    </div><!-- /.box -->

                    {!! Form::close() !!}

                </div><!-- /.col -->
            </div><!-- /.row -->

        </section>

    </div><!-- ./content-wrapper -->

@endsection

@section('js')
@endsection
