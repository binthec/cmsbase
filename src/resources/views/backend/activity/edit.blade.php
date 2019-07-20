@extends('cmsbase::backend.layouts.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>活動の様子を{{ ($activity->id === null)? '新規登録' : '編集' }}</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> 「活動の様子」に表示される記事を{{ ($activity->id === null)? '新規登録' : '編集' }}します。
            </p>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('activity.index') }}">活動の様子一覧</a></li>
                <li class="active">活動の様子を{{ ($activity->id === null)? '新規登録' : '編集' }}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    @if($activity->id === null)
                        {!! Form::open(['method' => 'post', 'route' => 'activity.store', 'files'=> true, 'class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'put', 'route' => ['activity.update', $activity], 'files'=> true, 'class' => 'form-horizontal']) !!}
                    @endif
                    {{ csrf_field() }}

                    <div class="box box-info">

                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-edit"></i> 入力してください </h3>
                        </div>

                        <div class="box-body">

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-sm-3 control-label">記事の名前 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('title', $activity->title, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '記事のタイトル']) }}

                                    @if($errors->has('title'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('title') }}</strong>
						            </span>
                                    @endif
                                    @if($errors->has('title'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('title') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date" class="col-sm-3 control-label">開催日 <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    {!! Form::text('date', ($activity->id !== null)? Helper::getNormalDateFromStd($activity->date) : $activity->date, ['class' => 'form-control use-datepicker', 'placeholder' => 'yyyy/mm/dd']) !!}

                                    @if($errors->has('date'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('date') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                                <label for="place" class="col-sm-3 control-label">開催場所 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('place', $activity->place, ['id' => 'place', 'class' => 'form-control', 'placeholder' => '開催した場所や地域名、会場名など']) }}

                                    @if($errors->has('place'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('place') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                                <label for="detail" class="col-sm-3 control-label">内容</label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('detail', $activity->detail, ['class' => 'form-control', 'id' => 'use-ckeditor']) !!}

                                    @if($errors->has('detail'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('detail') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form-group -->

                            <div class="form-group{{ $errors->has('pictures') ? ' has-error' : '' }}">
                                <label for="images" class="col-sm-3 control-label">画像</label>
                                <div class="col-sm-9">
                                    {{ Form::file('images[]', ['id' => 'images', 'class' => 'form-control', 'multiple']) }}
                                    @if($activity->id !== null)
                                        @foreach($activity->activityImages as $img)
                                            <div class="">
                                                <img src="{{ $img->getImageDir() .'/270x180_' . $img->name }}">
                                            </div>
                                        @endforeach
                                    @endif

                                    @if($errors->has('pictures'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('pictures') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <!-- /.col-sm-9 -->
                            </div>
                            <!-- form-group -->

                            <hr>

                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">プログラムの流れ</label>
                            </div>
                            <div id="time-tables">

                                @if(!empty($activity->timetable))

                                    @foreach($activity->timetable as $timetable)
                                        <div class="form-group time-table{{ $errors->has('timeline') ? ' has-error' : '' }}">
                                            <div class="col-sm-3 col-sm-offset-3">
                                                {{ Form::text('time[]', $timetable['time'], ['class' => 'form-control', 'placeholder' => '時間']) }}
                                            </div>

                                            <div class="col-sm-5">
                                                {{ Form::text('action[]', $timetable['action'], ['class' => 'form-control', 'placeholder' => '内容']) }}
                                            </div>

                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-danger del-btn">ー</button>
                                            </div>

                                            @if($errors->has('time'))
                                                <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('timeline') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <!-- form-group -->
                                    @endforeach

                                @else

                                    <div class="form-group time-table{{ $errors->has('timeline') ? ' has-error' : '' }}">
                                        <div class="col-sm-3 col-sm-offset-3">
                                            {{ Form::text('time[]', '', ['class' => 'form-control', 'placeholder' => '時間']) }}
                                        </div>

                                        <div class="col-sm-5">
                                            {{ Form::text('action[]', '', ['class' => 'form-control', 'placeholder' => '内容']) }}
                                        </div>

                                        <div class="col-sm-1">
                                            <button type="button" class="btn btn-danger del-btn">ー</button>
                                        </div>

                                        @if($errors->has('time'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('timeline') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <!-- form-group -->

                                @endif

                            </div>
                            <!-- /.time-tables -->

                            <div class="form-group margin-top20">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="button" class="btn btn-success" id="add-btn">＋</button>
                                </div>
                            </div>


                            <hr>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-sm-3 control-label">記事タイプ <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    {!! Form::select('type', \Binthec\CmsBase\Models\Activity::$typeList, $activity->type,['class' => 'form-control']) !!}
                                    @if($errors->has('type'))
                                        <span class="help-block">
							                <strong class="text-danger">{{ $errors->first('type') }}</strong>
						                </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form-group -->

                            <hr>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-sm-3 control-label">公開ステータス <span class="text-danger">*</span></label>
                                <div class="col-sm-9">

                                    <label class="radio-inline">
                                        @if(old('status') == \Binthec\CmsBase\Models\Activity::OPEN)
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Activity::OPEN, '', ['class' => 'flat-blue', 'checked']) }}
                                        @elseif($activity->id !== null && $activity->status === \Binthec\CmsBase\Models\Activity::OPEN)
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Activity::OPEN, true, ['class' => 'flat-blue']) }}
                                        @else
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Activity::OPEN, '', ['class' => 'flat-blue']) }}
                                        @endif
                                        公開
                                    </label>
                                    <label class="radio-inline">
                                        @if(old('status') == \Binthec\CmsBase\Models\Activity::CLOSE)
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Activity::CLOSE, '', ['class' => 'flat-blue', 'checked']) }}
                                        @elseif($activity->id === null || $activity->status === \Binthec\CmsBase\Models\Activity::CLOSE)
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Activity::CLOSE, true, ['class' => 'flat-blue']) }}
                                        @else
                                            {{ Form::radio('status', \Binthec\CmsBase\Models\Activity::CLOSE, '', ['class' => 'flat-blue']) }}
                                        @endif
                                        非公開
                                    </label>

                                    @if($errors->has('status'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('status') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div>
                            <!-- form-group -->

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">登　録</button>
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->

                    {!! Form::close() !!}

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- ./content-wrapper -->

@endsection
