@extends('backend.layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>ユーザのパスワードを変更</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> 既存ユーザのパスワードを変更します。
            </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    {!! Form::open(['method' => 'PUT', 'route' => ['user.password.update', $user], 'class' => 'form-horizontal']) !!}

                    <div class="box box-info">

                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-edit"></i> {{ $user->name }} のパスワードを変更します</h3>
                        </div>

                        <div class="box-body">

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

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="col-sm-9 col-sm-offset-3">
                                {!! Form::submit('登録する', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    </div><!-- /.box -->

                    {!! Form::close() !!}

                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>

    </div><!-- ./content-wrapper -->
@endsection
