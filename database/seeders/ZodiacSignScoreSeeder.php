<?php

namespace Database\Seeders;

use App\Http\Traits\GlobalTrait;
use App\Models\ZodiacSignScore;
use Illuminate\Database\Seeder;

class ZodiacSignScoreSeeder extends Seeder
{
    use GlobalTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //12 signs
        // $zodiacSigns = [
        //     'Aries', 'Taurus', 'Gemini', 'Cancer',
        //     'Leo', 'Virgo', 'Libra', 'Scorpio',
        //     'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
        // ];

        $zodiacSignIds = [
            1, 2, 3, 4,
            5, 6, 7, 8,
            9, 10, 11, 12
        ];

        $years = [
            2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
            2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040,
            2041, 2042, 2043, 2044, 2045, 2046, 2047, 2048, 2049, 2050,
            2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060,
            2061, 2062, 2063, 2064, 2065, 2066, 2067, 2068, 2069, 2070,

        ]; //seeding data for 50 years //took 100s

        foreach ($years as $year) {
            $dates = $this->getDatesByYear($year);
            foreach ($dates as $date) {
                $scoreDate = $date->format('Y-m-d');
                $scoreYear = $date->format('Y');
                $scoreMonth = $date->format('m');

                foreach ($zodiacSignIds as $zodiacSignId) {
                    ZodiacSignScore::create([
                        'zodiac_sign_id' => $zodiacSignId,
                        'score' => rand(1, 10),
                        'score_date' => $scoreDate,
                        'score_year' => $scoreYear,
                        'score_month' => $scoreMonth,
                    ]);
                }
            }
        }



        //
    }
}
