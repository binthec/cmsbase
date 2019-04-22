@extends('cmsbase::frontend.layouts.app')

@section('bodyId', 'act-list')

@section('content')
    <section id="timetable">
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">基本的なプログラムの流れ</h2>

                <div class="timetable">
                    <header class="clearfix">
                        <span>Timetable</span>
                        <h1>1日のタイムテーブル</h1>
                    </header>
                    <div class="main">

                        <ul class="cbp_tmtimeline">

                            <li>
                                <time class="cbp_tmtime" datetime="9:00">
                                    {{--<span>YYYY/MM/DD</span>--}}<span>9:00</span>
                                </time>
                                <div class="cbp_tmicon cbp_tmicon-earth"></div>
                                <div class="cbp_tmlabel">
                                    <h2>会場到着</h2>
                                    <p>会場に付き、ご担当者と挨拶、打ち合わせ。同時進行で、会場準備を行います。</p>
                                </div>
                            </li>

                            <li>
                                <time class="cbp_tmtime" datetime="9:30">
                                    {{--<span>YYYY/MM/DD</span>--}}<span>9:30</span>
                                </time>
                                <div class="cbp_tmicon cbp_tmicon-earth"></div>
                                <div class="cbp_tmlabel">
                                    <h2>開会</h2>
                                    <p>テキストテキスト</p>
                                </div>
                            </li>

                            <li>
                                <time class="cbp_tmtime" datetime="10:00">
                                    {{--<span>YYYY/MM/DD</span>--}}<span>10:00</span>
                                </time>
                                <div class="cbp_tmicon cbp_tmicon-earth"></div>
                                <div class="cbp_tmlabel">
                                    <h2>人形劇</h2>
                                    <p>テキストテキスト</p>
                                </div>
                            </li>

                            <li>
                                <time class="cbp_tmtime" datetime="11:00">
                                    {{--<span>YYYY/MM/DD</span>--}}<span>11:00</span>
                                </time>
                                <div class="cbp_tmicon cbp_tmicon-earth"></div>
                                <div class="cbp_tmlabel">
                                    <h2>体操</h2>
                                    <p>テキストテキスト</p>
                                </div>
                            </li>

                            <li>
                                <time class="cbp_tmtime" datetime="12:00">
                                    {{--<span>YYYY/MM/DD</span>--}}<span>12:00</span>
                                </time>
                                <div class="cbp_tmicon cbp_tmicon-earth"></div>
                                <div class="cbp_tmlabel">
                                    <h2>閉会、懇親会へ</h2>
                                    <p>テキストテキスト</p>
                                </div>
                            </li>

                            <li>
                                <time class="cbp_tmtime" datetime="13:00">
                                    {{--<span>YYYY/MM/DD</span>--}}<span>13:00</span>
                                </time>
                                <div class="cbp_tmicon cbp_tmicon-earth"></div>
                                <div class="cbp_tmlabel">
                                    <h2>撤収</h2>
                                    <p>テキストテキスト</p>
                                </div>
                            </li>

                        </ul>
                    </div><!-- /.main -->
                </div><!-- /.timetable -->

            </div>

            <div class="act-list">

            </div><!-- /.act-list -->

        </div><!-- /.container -->
    </section>

    <section id="act">
        <div class="container">

            @include('cmsbase::frontend.activity.small-list')

            @if($activities->count() > 0)
                <div class="section-footer">
                    {{ $activities->links() }}
                </div>
            @endif

        </div><!-- /.container -->
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="/lib/vertical-timeline/css/component.css"/>
    <link rel="stylesheet" href="/lib/vertical-timeline/css/default.css"/>
@endsection

@section('js')
    <script src="/lib/vertical-timeline/js/modernizr.custom.js"></script>
@endsection