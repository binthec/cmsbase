@extends('cmsbase::backend.layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>マイページ</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> ユーザ情報の確認と変更が出来ます。
            </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $user->name }}</h3>
                            <p>{{ \App\User::$roles[$user->role] }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                    </div>

                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-md-6">

                    <div class="box box-warning">
                        <div class="box-header">
                            <p class="box-title">ユーザ名変更</p>
                            <p class="content-description">
                                <i class="fa fa-info-circle"></i> 変更する場合のみ入力してください。
                            </p>
                        </div>
                        <div class="box-body box-profile">

                            {!! Form::open(['method' => 'PUT', 'route' => ['user.update', $user], 'class' => 'form-horizontal']) !!}

                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">ユーザ名 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'ユーザ名']) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {!! Form::submit('ユーザ名変更', ['class' => 'btn btn-block btn-warning']) !!}
                            {!! Form::close() !!}

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->


                <div class="col-md-6">

                    <div class="box box-warning">
                        <div class="box-header">
                            <p class="box-title">パスワード変更</p>
                            <p class="content-description">
                                <i class="fa fa-info-circle"></i> 変更する場合のみ入力してください。
                            </p>
                        </div>
                        <div class="box-body box-profile">

                            {!! Form::open(['method' => 'PUT', 'route' => ['user.password.update', $user], 'class' => 'form-horizontal']) !!}

                            <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-sm-3 control-label">新しいパスワード <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => '新しいパスワードを入力']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirmation" class="col-sm-3 control-label">パスワード再入力 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirmation', 'placeholder' => 'パスワードをもう一度入力してください']) !!}
                                </div>
                            </div>

                            {!! Form::submit('パスワード変更', ['class' => 'btn btn-block btn-warning']) !!}
                            {!! Form::close() !!}

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->


            </div><!-- /.row -->
        </section>

    </div><!-- ./content-wrapper -->
@endsection
