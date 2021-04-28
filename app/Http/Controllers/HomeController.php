<?php

namespace App\Http\Controllers;

use App\Models\ZodiacSignScore;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    public function events()
    {
        $givenYear = config('horoscope.given_year');

        $zodiacSingScores = ZodiacSignScore::where('score_year', $givenYear)->get();

        $events = [];
        foreach ($zodiacSingScores as $zodiacSingScore) {
            $title = optional($zodiacSingScore->zodiacSign)->title;

            $comment = optional($zodiacSingScore->scoreComment)->score_comment; //score value and score both are same number

            $startDay = Carbon::parse($zodiacSingScore->score_date)->format('Y-m-d');
            $score = $zodiacSingScore->score;

            //Background colors by score: 
            $background = [
                '#000000', //wont be used
                '#ff0000', //worst day
                '#ee0000',
                '#dd0000',
                '#cc0000',
                '#bb0000',
                '#aa0000',
                '#00aa00',
                '#00bb00',
                '#00cc00',
                '#00ff00' // best day
            ];

            $event['title'] = "$title - $comment";
            $event['start'] = $startDay;
            $event['score'] = $score;
            $event['score_comment'] = $comment;
            $event['backgroundColor'] = $background[$score];
            $event['fullObject'] = $zodiacSingScore;

            $events[] = $event;
        }

        return response()->json($events, 200);
    }
}
