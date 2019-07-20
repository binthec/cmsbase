@extends('cmsbase::frontend.layouts.app')

@section('bodyId', 'home')

@section('content')

    {{-- トップ画像のスライダー --}}
    @if($topimages->count() > 0)
        <section>
            <div class="top-slider">
                @foreach($topimages as $img)
                    <div><img src="{{ $img->getImagePath() }}"></div>
                @endforeach
            </div>
        </section>
    @endif

    <section id="services">
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">活動の主旨と内容</h2>
                <p class="text-center wow fadeInDown">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et
                    dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="0ms">
                        <div class="media service-box">
                            <div class="pull-left">
                                <img src="/frontend/images/icon1.png" alt="img">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Responsive Design</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur
                                    ing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
                                    ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div>
                    <!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="100ms">
                        <div class="media service-box">
                            <div class="pull-left">
                                <img src="/frontend/images/icon2.png" alt="img">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">UX Design</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur
                                    ing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
                                    ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div>
                    <!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="200ms">
                        <div class="media service-box">
                            <div class="pull-left">
                                <img src="/frontend/images/icon3.png" alt="img">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">UI Design</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur
                                    ing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipis
                                    ing elit, sed do eiusmod .</p>
                            </div>
                        </div>
                    </div>
                    <!--/.col-md-4-->
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </section>
    <!--/#services-->

    @if($activities->count() > 0)
        <section id="act">
            <div class="container">

                @include('cmsbase::frontend.activity.small-list')

                <div class="section-footer">
                    <div class="wow fadeInLeft">
                        <a href="{{ route('front.act.index') }}" class="btn btn-primary">もっと見る</a>
                    </div>
                </div>
                <!-- /.section-footer -->

            </div>
            <!-- /.container -->
        </section>
        <!--/#act-->
    @endif


    <section id="animated-number">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Special Thanks!!</h2>
                <p class="text-center wow fadeInDown">
                    私達「▲▲▲▲▲▲」は、○○○○の資金提供を受けて活動を行っています。<br>
                    皆様のご協力に感謝致します。
                </p>
            </div>
        </div>
    </section>
    <!--/#animated-number-->


    <section id="events">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">活動予定カレンダー</h2>
                <p class="text-center wow fadeInDown">
                    今後の活動の予定をご紹介します。
                </p>
            </div>

            <div class="row">
                <div class="col-md-8 col-lg-offset-2">
                    <div id="calendar"></div>
                </div>
            </div>

        </div>
        <!-- /.container -->
    </section>
    <!--/#events-->


    <section id="testimonial">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">主催者</h2>
                <p class="text-center wow fadeInDown">主催者紹介</p>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel-one">
                        <div class="user-img"><img alt="" src="/frontend/images/testimonail_1.jpg"></div>
                        <div class="testi-info">
                            <h4>日本 太郎</h4>
                            <h5></h5>
                            <p>
                                紹介文。テキストテキスト。紹介文。テキストテキスト。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!--/#testimonial-->


    <section id="get-in-touch">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">CONTACT</h2>
                <p class="text-center wow fadeInDown">
                    お問い合わせはこちらからお願い致します。１週間以内にご連絡致します。
                </p>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <form action="#" method="post" name="contact-form" id="main-contact-form">
                        <div class="form-group">
                            <input type="text" required placeholder="お名前 *" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <input type="email" required placeholder="メールアドレス *" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <input type="text" required placeholder="タイトル *" class="form-control" name="subject">
                        </div>
                        <div class="form-group">
                            <textarea required placeholder="内容 *" rows="8" class="form-control" name="message"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">送　信</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </section>
    <!--/#get-in-touch-->

@endsection


@section('css')
    @include('cmsbase::common.top-css')
@endsection

@section('js')
    @include('cmsbase::common.top-js')
    <script>
        //OWL for Activity
        $(document).ready(function ($) {
            $("#owl-box").owlCarousel();
        });
        $("#owl-box").owlCarousel({
            items: 4,
        })
    </script>
@endsection