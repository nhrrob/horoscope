<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

trait GlobalTrait
{

    public function adminOnly()
    {
        if (Auth::user()->role != 'admin') {
            die('Permission denied!');
        }
    }

    public function getDatesByYear(int $year): array
    {
        $dates = [];
        $dateStart = "$year-01-01";
        $dateEnd = "$year-12-31";
        $period = CarbonPeriod::create($dateStart, $dateEnd);

        // Iterate over the period
        // foreach ($period as $date) {
        //     echo $date->format('Y-m-d');
        // }

        // Convert the period to an array of dates
        $dates = $period->toArray();
        return $dates;
    }
}
