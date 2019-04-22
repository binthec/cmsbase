<!DOCTYPE html>
<html class="no-js" lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> {{ config('app.name') }} | Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSS for Tools -->
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/lib/AdminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="/lib/AdminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/lib/select2/select2.css">
    <link rel="stylesheet" href="/lib/Ionicons/css/ionicons.css">
    <link rel="stylesheet" href="/lib/iCheck/all.css">
    <link rel="stylesheet" href="/lib/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/lib/dropzone/dropzone-custom.css">
    <link rel="stylesheet" href="/lib/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="/lib/fullcalendar/fullcalendar.print.min.css" media="print">

    @yield('css')

    <link rel="stylesheet" href="/backend/css/custom.css">
    <link rel="stylesheet" href="/common/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini" id="@yield('bodyId')">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <span class="logo-mini"><b><i class="fa fa-cog"></i></b></span>
            <span class="logo-lg"><b>{{ config('app.name') }}</b>Admin</span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                            <span class="hidden-xs"> {{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <i class="fa fa-child"></i>
                                <p>
                                    <span class="text-lg">{{ Auth::user()->name }}</span><br>
                                    <span class="text-sm">{{ \Binthec\CmsBase\Models\User::$roles[Auth::user()->role] }}</span>
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('mypage') }}" class="btn btn-default btn-flat">マイページ</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li><!-- /.user-footer -->

                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">メインメニュー</li>

                <li class="{{ Helper::isActiveUrl('dashboard') }}">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>

                <li class="treeview {{ Helper::isActiveUrl('topimage*') }}">
                    <a href="#">
                        <i class="fa fa-image"></i> <span>トップ画像</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu {{ Helper::isActiveUrl('topimage*') }}">
                        <li class="{{ Helper::isActiveUrl('topimage') }}"><a href="{{ route('topimage.index') }}"><i class="fa fa-circle-o"></i> 一覧表示・編集</a></li>
                        <li class="{{ Helper::isActiveUrl('topimage/create') }}"><a href="{{ route('topimage.create') }}"><i class="fa fa-circle-o"></i> 新規登録</a></li>
                        <li class="{{ Helper::isActiveUrl('topimage/order') }}"><a href="{{ route('topimage.order.edit') }}"><i class="fa fa-circle-o"></i> 表示順</a></li>
                    </ul>
                </li>

                <li class="treeview {{ Helper::isActiveUrl('activity*') }}">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>活動の様子</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu {{ Helper::isActiveUrl('topimage*') }}">
                        <li class="{{ Helper::isActiveUrl('activity') }}"><a href="{{ route('activity.index') }}"><i class="fa fa-circle-o"></i> 一覧表示・編集</a></li>
                        <li class="{{ Helper::isActiveUrl('activity/create') }}"><a href="{{ route('activity.create') }}"><i class="fa fa-circle-o"></i> 新規登録</a></li>
                    </ul>
                </li>

                <li class="{{ Helper::isActiveUrl('event') }}">
                    <a href="{{ route('event.index') }}"><i class="fa fa-calendar"></i> <span>カレンダー</span></a>
                </li>

                @can('owner-higher')
                    <li class="header">管理メニュー</li>

                    <li class="treeview {{ Helper::isActiveUrl('user*') }}">
                        <a href="#">
                            <i class="fa fa-newspaper-o"></i> <span>ユーザ管理</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu {{ Helper::isActiveUrl('topimage*') }}">
                            <li class="{{ Helper::isActiveUrl('user') }}"><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> 一覧表示・編集</a></li>
                            <li class="{{ Helper::isActiveUrl('user/create') }}"><a href="{{ route('user.create') }}"><i class="fa fa-circle-o"></i> 新規登録</a></li>
                        </ul>
                    </li>
                @endcan

                @can('system-only')
                    <li class="{{ Helper::isActiveUrl('actionlog*') }}">
                        <a href="{{ route('actionlog.index') }}"><i class="fa fa-circle-o text-aqua"></i> <span>操作ログ閲覧</span></a>
                    </li>
                @endcan
            </ul>
        </section><!-- /.sidebar -->

    </aside>

    {{-- フラッシュメッセージの表示 --}}
    @if (Session::has('flashMsg'))
        <div class="flash-msg">{{ Session::get('flashMsg') }}</div>
    @elseif(Session::has('flashErrMsg'))
        <div class="flash-msg err">{{ Session::get('flashErrMsg') }}</div>
    @endif

    @yield('content')

    <footer class="main-footer">
        <div class="pull-right hidden-xs"><b>Version</b> 1.0.0</div>
        <strong>Copyright &copy; 2017- 大分県体力づくり研究会.</strong> All rightsreserved.
    </footer>

</div><!-- ./wrapper -->

{{--<script src="/lib/jquery/jquery.js"></script><!-- jQuery 3 -->--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/lib/jquery-ui/jquery-ui.js"></script><!-- jQuery UI 1.11.4 -->

<!-- Tools JS -->
<script src="/lib/bootstrap/js/bootstrap.js"></script>
<script src="/lib/select2/select2.js"></script>
<script src="/lib/iCheck/icheck.js"></script>
<script src="/lib/ckeditor/ckeditor.js"></script>
<script src="/lib/moment/moment.js"></script>
<script src="/lib/moment/locale/ja.js"></script>
<script src="/lib/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="/lib/bootstrap-datepicker/locales/bootstrap-datepicker.ja.min.js"></script>
<script src="/lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="/lib/dropzone/dropzone.js"></script>
<script src="/lib/fullcalendar/fullcalendar.min.js"></script>
<script src="/lib/fullcalendar/locale/ja.js"></script>
<script src="/lib/AdminLTE/js/adminlte.js"></script>

@yield('js')

<script src="/backend/js/custom.js"></script>
<script src="/backend/js/functions.js"></script>

</body>
</html>