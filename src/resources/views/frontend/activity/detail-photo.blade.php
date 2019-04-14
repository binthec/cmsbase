@extends('frontend.layouts.app')

@section('bodyId', 'act-detail')

@section('content')
    <section id="act">
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">{{ $actSingle->title }}</h2>
                <p class="text-center wow fadeInDown">
                    <span class="entry-date">{{ getJaDate($actSingle->date) }}</span>
                    <span class="entry-place">於&ensp;{{ $actSingle->place }}</span>
                </p>
            </div>

            <div class="row">
                <div class="col-md-12">

                    @if($actSingle->detail !== null)
                        <div class="post">{!! $actSingle->detail !!}</div>
                    @endif

                </div><!-- /.col -->
            </div><!-- /.row -->

            <div id="masonry-photo-base" class="row">
                <div class="col-md-12">
                    <div class="grid">
                        @foreach($actSingle->pictures as $pict)
                            <img class="grid-item"
                                 src="{{ $pict->getPictPath(\App\Activity::$pictPrefix[\App\Activity::PHOTO_BASE]) }}"
                                 width="{{ $pict->getImgSize('w', \App\Activity::$pictPrefix[\App\Activity::PHOTO_BASE]) }}"
                                 height="{{ $pict->getImgSize('h', \App\Activity::$pictPrefix[\App\Activity::PHOTO_BASE]) }}">
                        @endforeach
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->

            @include('frontend.activity.small-list')
            @include('frontend.activity.see-more')

        </div><!-- /.container -->
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="/vendor/vertical-timeline/css/component.css"/>
    <link rel="stylesheet" href="/vendor/vertical-timeline/css/default.css"/>
@endsection

@section('js')
    <script src="/vendor/masonry/masonry.pkgd.js"></script>
    <script>
        $('.grid').masonry({
            itemSelector: '.grid-item',
            fitWidth: true,
            columnWidth: 270,
            gutter: 10,
        });
    </script>
@endsection