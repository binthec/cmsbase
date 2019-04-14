@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>ユーザ一覧</h1>
            <small>
                <i class="fa fa-info-circle"></i> 管理者としてログイン出来るユーザの一覧です。
            </small>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border text-right">
                            <a class="btn btn-primary" href="{{ route('user.create') }}">新規登録</a>
                        </div><!-- /.box-header -->

                        <div class="box-body">
                            @if($users->count() > 0)
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="bg-primary text-center">
                                        <th>ユーザ名</th>
                                        <th>作成日</th>
                                        <th>最終変更日</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ getJaDateTime($user->created_at) }}</td>
                                            <td class="text-center">{{ getJaDateTime($user->updated_at) }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">ユーザ名変更</a>
                                                &emsp;
                                                <a href="{{ route('user.password.edit', $user->id) }}" class="btn btn-warning">パスワード変更</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                ユーザが存在しません
                            @endif

                        </div><!-- /.box-body -->

                        @if($users->count() > 0)
                            <div class="box-footer">
                                {{ $users->links() }}
                            </div>
                        @endif

                    </div><!-- /.box -->

                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </section>

    </div><!-- /.content-wrapper -->
@endsection
