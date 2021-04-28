@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Zodiac Sign Score') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if(auth()->user()->role == 'admin')
                    <p><a class="btn btn-success" href='{{ route("zodiac-sign-scores.create") }}'><i class="fa fa-plus"></i> Create Zodiac Sign Score</a></p>
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
                            @forelse($zodiacSignScores as $zodiacSignScore)
                            <tr>
                                <td>
                                    {{ $zodiacSignScore->title ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ optional($zodiacSignScore->created_at)->diffForHumans() }}
                                </td>

                                <td>
                                    @if(auth()->user()->role == 'admin')
                                    <a class="btn btn-success d-block mb-2" href='{{ route("zodiac-sign-scores.edit", $zodiacSignScore->id) }}'><i class="fa fa-pencil"></i> Edit</a>
                                    <!-- <form method="POST" action="{{ route('zodiac-sign-scores.destroy', $zodiacSignScore->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <i class="fa fa-times"></i>
                                            <input type="submit" class="btn btn-danger d-block" value="Delete">
                                        </div>
                                    </form> -->
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
                    
                    <!-- Pagination  -->
                    <div class="d-flex justify-content-center">
                        {!! $zodiacSignScores->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection