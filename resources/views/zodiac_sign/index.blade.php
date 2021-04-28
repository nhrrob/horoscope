@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Zodiac Sign') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if(auth()->user()->role == 'admin')
                    <p><a class="btn btn-success" href='{{ route("zodiac-signs.create") }}'><i class="fa fa-plus"></i> Create Zodiac Sign</a></p>
                    @endif 

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Created
                                </th>
                                <th width="5%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($zodiacSigns as $zodiacSign)
                            <tr>
                                <td>
                                    {{ $zodiacSign->title ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ optional($zodiacSign->created_at)->diffForHumans() }}
                                </td>

                                <td>
                                    @if(auth()->user()->role == 'admin')
                                    <a class="btn btn-success d-block mb-2" href='{{ route("zodiac-signs.edit", $zodiacSign->id) }}'><i class="fa fa-pencil"></i> Edit</a>
                                    @endif 
                                    <!-- <form method="POST" action="{{ route('zodiac-signs.destroy', $zodiacSign->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <i class="fa fa-times"></i>
                                            <input type="submit" class="btn btn-danger d-block" value="Delete">
                                        </div>
                                    </form> -->

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" align="center">No records found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection