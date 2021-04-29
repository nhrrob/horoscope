<form class="form-horizontal pt-4" style="width:60%; margin:auto;" method="POST" action='{{ route("home.index") }}' enctype="multipart/form-data">
    @csrf

    <p class="alert alert-success text-center" style="font-size: 16px; margin: 0 15px">Select a Year and your Zodiac sign!</p>
    <p class="mb-4"></p>
    <!-- Fields Start -->
    <div class="form-group">
        <div class="col-sm-12">
            <select class="form-control m-b" name="year">
                <option value="2021">Years</option>
                @foreach($years as $year)
                <option value="{{$year}}" {{ isset($yearSelected) && $yearSelected == $year ? 'selected' : ''}}>{{$year}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <select class="form-control m-b" name="zodiacSign">
                <option value="0">Zodiac Signs</option>
                @foreach($zodiacSigns as $zodiacSign)
                <option value="{{$zodiacSign->id}}" {{ isset($zodiacSignSelected) && $zodiacSignSelected == $zodiacSign->id ? 'selected' : ''}}>{{$zodiacSign->title}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- Fields End -->

    <div class="form-group">
        <div class="col-md-12">
            <div class="align-right" style="text-align: right;">
                <button class="btn btn-success btn-width-same-lg" type="submit" style="width: 100px;">Filter</button>
            </div>
        </div>
    </div>
</form>