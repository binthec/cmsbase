@if(!empty($actSingle->timetable))
    <div class="timetable">
        <header class="clearfix">
            <span>Programm</span>
            <h1>プログラムの流れ</h1>
        </header>
        <div class="main">
            <ul class="cbp_tmtimeline">

                @foreach($actSingle->timetable as $timetable)
                    <li>
                        @if(!empty($timetable['time']))
                            <time class="cbp_tmtime" datetime="{{ $timetable['time'] }}}">
                                <span>{{ getMdDate($actSingle->date) }}</span> <span>{{ $timetable['time'] }}</span>
                            </time>
                        @endif
                        <div class="cbp_tmicon cbp_tmicon-earth"></div>
                        <div class="cbp_tmlabel">
                            <h2>{{$timetable['action']}}</h2>
                            {{--<p>テキストテキスト</p>--}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div><!-- /.container -->
@endif