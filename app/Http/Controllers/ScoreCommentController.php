<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreCommentRequest;
use App\Models\ScoreComment;
use Exception;

class ScoreCommentController extends Controller
{
    public function index()
    {
        $data['scoreComments'] = ScoreComment::latest()->paginate(10);
        return view('score_comment.index', $data);
    }

    public function create()
    {
        return view('score_comment.create');
    }

    public function store(ScoreCommentRequest $request)
    {
        try{
            $scoreComment = ScoreComment::create($request->all());

            $notification = array(
                'message' => 'Score Comment saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('score-comments.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('score-comments.index')->with($notification);
        }
    }

    public function show(ScoreComment $scoreComment)
    {
        //
    }

    public function edit(ScoreComment $scoreComment)
    {
        $data['scoreComment'] = $scoreComment;
        return view('score_comment.edit', $data);
    }

    public function update(ScoreCommentRequest $request, ScoreComment $scoreComment)
    {
        try {
            $scoreComment = $scoreComment->update($request->all());

            $notification = array(
                'message' => 'Score Comment saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('score-comments.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('score-comments.index')->with($notification);
        }
    }

    public function destroy(ScoreComment $scoreComment)
    {
        try{
            ScoreComment::find($scoreComment->id)->delete();

            $notification = array(
                'message' => 'Score Comment deleted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('score-comments.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('score-comments.index')->with($notification);
        }
    }
}
