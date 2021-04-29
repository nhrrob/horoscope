<?php

namespace App\Http\Controllers;

use App\Models\ZodiacSign;
use App\Models\ZodiacSignScore;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['showCalendar'] = 0;
        $data['yearSelected'] = 0;
        $data['zodiacSignSelected'] = 0;

        $data['zodiacSigns'] = ZodiacSign::all();
        $data['years'] = [
            2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
            2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040,
            2041, 2042, 2043, 2044, 2045, 2046, 2047, 2048, 2049, 2050,
            2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060,
            2061, 2062, 2063, 2064, 2065, 2066, 2067, 2068, 2069, 2070,

        ];

        if ($request->method() == 'GET') {
            return view('home', $data);
        }

        $yearSelected = $request->year;
        $zodiacSignSelected = $request->zodiacSign;

        $data['showCalendar'] = 1;
        $data['yearSelected'] = $yearSelected;
        $data['zodiacSignSelected'] = $zodiacSignSelected;
        $data['zodiacSignObj'] = ZodiacSign::find($zodiacSignSelected);

        $dataStat = $this->getStats($yearSelected, $zodiacSignSelected);
        $data = array_merge($data, $dataStat);
        // dd($data);

        return view('home', $data);
    }

    public function events(Request $request)
    {
        $givenYear = $request->input('year') ?? config('horoscope.given_year');
        $zodiacSignValue = $request->input('amp;zodiacSign') ?? 0;

        $zodiacSingScores = ZodiacSignScore::where('score_year', $givenYear);

        if ($zodiacSignValue > 0) {
            $zodiacSingScores = $zodiacSingScores->where('zodiac_sign_id', $zodiacSignValue);
        }

        $zodiacSingScores = $zodiacSingScores->get();

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


    public function getStats($yearSelected, $zodiacSignSelected)
    {

        //Task 1: Zodica sign's best month  : param - year
        $monthlyScore = [];
        $data = [];

        //get score by month, year and zodiac sign
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $maxAverage = 0;
        $monthDays = [
            cal_days_in_month(CAL_GREGORIAN, 1, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 2, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 3, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 4, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 5, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 6, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 7, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 8, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 9, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 10, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 11, $yearSelected),
            cal_days_in_month(CAL_GREGORIAN, 12, $yearSelected)
        ];

        foreach ($months as $key => $month) {
            $monthlyScore[$key] = ZodiacSignScore::where('score_year', $yearSelected)
                ->where('score_month', $key + 1)
                ->where('zodiac_sign_id', $zodiacSignSelected)
                ->get()
                ->pluck('score')
                ->sum();

            $average[$key] = $monthlyScore[$key] / $monthDays[$key];

            if ($average[$key] > $maxAverage) {
                $maxAverage = $average[$key];
                $bestMonth = $month;
                $bestMonthIndex = $key;
            }
        }

        //Best month by zodiac sign for a given year : by score average
        if ($zodiacSignSelected > 0) {
            $data['bestMonthByZS']['monthlyScore'] = $monthlyScore;
            $data['bestMonthByZS']['monthlyAverage'] = $average;
            $data['bestMonthByZS']['maxAverage'] = $maxAverage;
            $data['bestMonthByZS']['bestMonth'] = $bestMonth;
            $data['bestMonthByZS']['bestMonthIndex'] = $bestMonthIndex;
        }

        //Task 2: Best zodiac sign for a given year : by score
        $data['bestZSByYear'] = [];

        //Get scores by year : store in zs named array
        $maxYearlyScore = 0;

        for ($i = 0; $i <= 11; $i++) {
            //get scores for a year
            $yearlyScore[$i] = ZodiacSignScore::where('score_year', $yearSelected)
                ->where('zodiac_sign_id', $i + 1)
                ->get()
                ->pluck('score')
                ->sum();

            if ($yearlyScore[$i] > $maxYearlyScore) {
                $maxYearlyScore = $yearlyScore[$i];
                $bestZSIndex = $i;
            }
        }

        $data['bestZSByYear']['yearlyScore'] = $yearlyScore;
        $data['bestZSByYear']['maxYearlyScore'] = $maxYearlyScore;
        $data['bestZSByYear']['bestZS'] = ZodiacSign::find($bestZSIndex + 1);
        $data['bestZSByYear']['bestZSId'] = $bestZSIndex + 1;

        return $data;
    }
}
