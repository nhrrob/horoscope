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

                    {{ __('Welcome to NHR Horoscope!') }}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <p style="margin-bottom: 50px;"></p>

            <div class="card">
                <div class="card-header">{{ __('Horoscope Calendar') }}</div>

                <div class="card-body">
                    <div id='calendar'></div>
                </div>
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
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

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
            events: "{{ route('home.events') }}",
        });
    });
</script>
@endpush