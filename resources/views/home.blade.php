@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p class="text-center">{{ __('Welcome to NHR Horoscope! Filter to get your desired horoscopes!') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <p style="margin-bottom: 50px;"></p>

            <div class="card">
                <?php $givenYear = request()->get('year') != '' ? request()->get('year') : '2021'; ?>
                <div class="card-header">{{ __('Horoscope Calendar - ') . $givenYear }}</div>

                @include('partials.filter')

                @if($showCalendar)
                @include('partials.statistics')
                <hr>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
                @endif

            </div>


        </div>

    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {

        /* initialize the calendar
         -----------------------------------------------------------------*/
        let date = new Date();
        let year = '{{$yearSelected}}';

        if (year > 0) {
            date = '{{ $yearSelected }}' + '-01-01';
        }
        var count = 0;

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: "{{ route('home.events', ['year'=>$yearSelected, 'zodiacSign'=>$zodiacSignSelected]) }}",
            loading: function(bool) {
                //this function is called twice by fullcalendar
                if(count == 0){
    
                    $('.fullcalendar-loader').html('<p class="text-center alert alert-info">Events are being rendered...</p>');
                }else {
                    $('.fullcalendar-loader').html('');
                }
                count = 1;
            },
            eventAfterAllRender: function(view) {
                $('.fullcalendar-loader').html('<p class="text-center alert alert-success">All events are rendered!</p>');
            }
        });

        const calendarEl = $('#calendar').fullCalendar('getView').calendar;

        if (typeof calendarEl != 'undefined') {
            $('#calendar').fullCalendar('getView').calendar.gotoDate(date);;
        }

    });
</script>
@endpush