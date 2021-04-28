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

        $years = [2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030]; //seeding data for 10 years

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
