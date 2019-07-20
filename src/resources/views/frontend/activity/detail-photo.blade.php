@extends('cmsbase::frontend.layouts.app')

@section('bodyId', 'act-detail')

@section('content')
    <section id="act">
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">{{ $actSingle->title }}</h2>
                <p class="text-center wow fadeInDown">
                    <span class="entry-date">{{ Helper::getJaDate($actSingle->date) }}</span>
                    <span class="entry-place">於&ensp;{{ $actSingle->place }}</span>
                </p>
            </div>

            @include('cmsbase::frontend.activity.timetable')

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
                        @foreach($actSingle->activityImages as $img)
                            <img class="grid-item"
                                 src="{{ $img->getPhotoBaseImgPath() }}">
                        @endforeach
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->

            @include('cmsbase::frontend.activity.small-list')
            @include('cmsbase::frontend.activity.see-more')

        </div><!-- /.container -->
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="/lib/vertical-timeline/css/component.css"/>
    <link rel="stylesheet" href="/lib/vertical-timeline/css/default.css"/>
@endsection

@section('js')
    <script src="/lib/masonry/masonry.pkgd.js"></script>
    <script>
        $('.grid').masonry({
            itemSelector: '.grid-item',
            fitWidth: true,
            columnWidth: 270,
            gutter: 10,
        });
    </script>
@endsection