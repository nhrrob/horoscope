@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Score Comment') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if(auth()->user()->role == 'admin')
                    <!-- <p><a class="btn btn-success" href='{{ route("score-comments.create") }}'><i class="fa fa-plus"></i> Create Score Comment</a></p> -->
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Comment
                                </th>
                                
                                <th>
                                    Score
                                </th>

                                <th>
                                    Created
                                </th>
                                <th width="5%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($scoreComments as $scoreComment)
                            <tr>
                                <td>
                                    {{ $scoreComment->score_comment ?? 'N/A' }}
                                </td>
                                
                                <td>
                                    {{ $scoreComment->score_value ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ optional($scoreComment->created_at)->diffForHumans() }}
                                </td>

                                <td>
                                    @if(auth()->user()->role == 'admin')
                                    <a class="btn btn-success d-block mb-2" href='{{ route("score-comments.edit", $scoreComment->id) }}'><i class="fa fa-pencil"></i> Edit</a>
                                    <!-- <form method="POST" action="{{ route('score-comments.destroy', $scoreComment->id) }}">
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
                        {!! $scoreComments->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection