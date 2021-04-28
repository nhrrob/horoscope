@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Horoscope') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if(auth()->user()->role == 'admin')
                    <p><a class="btn btn-success" href='{{ route("horoscopes.create") }}'><i class="fa fa-plus"></i> Create Horoscope</a></p>
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
                            @forelse($horoscopes as $horoscope)
                            <tr>
                                <td>
                                    {{ $horoscope->title ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ optional($horoscope->created_at)->diffForHumans() }}
                                </td>

                                <td>
                                    @if(auth()->user()->role == 'admin')
                                    <a class="btn btn-success d-block mb-2" href='{{ route("horoscopes.edit", $horoscope->id) }}'><i class="fa fa-pencil"></i> Edit</a>

                                    <form method="POST" action="{{ route('horoscopes.destroy', $horoscope->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <i class="fa fa-times"></i>
                                            <input class="btn btn-danger d-block" type="submit" value="Delete">
                                        </div>
                                    </form>
                                    @endif 
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