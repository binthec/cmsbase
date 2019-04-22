<script src="/lib/slick/slick.min.js"></script>
<script>
    //Top Slider
    $('.top-slider').slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    /**
     * カレンダー
     *
     * @type {jQuery}
     */
    var calendar = $('#calendar').fullCalendar({
        locale: 'ja',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,listYear'
        },
        views: {
            listYear: {buttonText: '1年の予定'}
        },
        noEventsMessage: '予定がありません。',
        events: [
                @foreach($events as $id => $event)
            {
                id: "{{ $id }}",
                title: "{{ $event['title'] }}",
                start: "{{ $event['start'] }}",
            },
            @endforeach
        ],
    });
</script>