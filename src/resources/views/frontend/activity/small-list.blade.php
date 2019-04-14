@if($activities->count() > 0)

    <div class="section-header">
        <h2 class="section-title text-center wow fadeInDown">{{ isset($actSingle)? 'その他の記事' : '最近の活動の様子' }}</h2>
        @if(!isset($actSingle))
            <p class="text-center wow fadeInDown">最近の活動を紹介します。</p>
        @endif
    </div>

    <div class="act-list">
        @foreach($activities as $act)
            <div class="small-post">

                <img src="{{ $act->getMainPictPath() }}" class="thum">

                <div class="post-text">
                    <h5 class="entry-title">{{ mb_strimwidth($act->title, 0, 48, "...") }}</h5>
                    <p>
                        <span class="date">{{ getJaDate($act->date) }}</span><span class="place">{{ $act->place }}</span>
                    </p>
                </div><!-- /.post-text -->

                <a class="read-more" href="{{ route('front.act.detail', $act) }}">読む</a>

            </div><!-- /.small-post -->
        @endforeach
    </div><!-- /.act-list -->

@endif