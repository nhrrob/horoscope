<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZodiacSignScoreRequest;
use App\Models\ZodiacSignScore;
use Exception;

class ZodiacSignScoreController extends Controller
{
    public function index()
    {
        $data['zodiacSignScores'] = ZodiacSignScore::latest()->paginate(10);
        return view('zodiac_sign_score.index', $data);
    }

    public function create()
    {
        return view('zodiac_sign_score.create');
    }

    public function store(ZodiacSignScoreRequest $request)
    {
        try{
            $zodiacSignScore = ZodiacSignScore::create($request->all());

            $notification = array(
                'message' => 'Zodiac Sign Score saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('zodiac-sign-scores.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('zodiac-sign-scores.index')->with($notification);
        }
    }

    public function show(ZodiacSignScore $zodiacSignScore)
    {
        //
    }

    public function edit(ZodiacSignScore $zodiacSignScore)
    {
        $data['zodiacSignScore'] = $zodiacSignScore;
        return view('zodiac_sign_score.edit', $data);
    }

    public function update(ZodiacSignScoreRequest $request, ZodiacSignScore $zodiacSignScore)
    {
        try {
            $zodiacSignScore = $zodiacSignScore->update($request->all());

            $notification = array(
                'message' => 'Zodiac Sign Score saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('zodiac-sign-scores.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('zodiac-sign-scores.index')->with($notification);
        }
    }

    public function destroy(ZodiacSignScore $zodiacSignScore)
    {
        try{
            ZodiacSignScore::find($zodiacSignScore->id)->delete();

            $notification = array(
                'message' => 'Zodiac Sign Score deleted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('zodiac-sign-scores.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('zodiac-sign-scores.index')->with($notification);
        }
    }
}
