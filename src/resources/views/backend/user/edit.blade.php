@extends('backend.layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>ユーザ名を変更します</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> 既存のユーザ名を変更します。
            </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    {!! Form::open(['method' => 'PUT', 'route' => ['user.update', $user], 'class' => 'form-horizontal']) !!}

                    <div class="box box-info">

                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-edit"></i> {{ $user->name }} のユーザ名を変更します。</h3>
                        </div>

                        <div class="box-body">

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
