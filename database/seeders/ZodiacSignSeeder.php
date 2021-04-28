<?php

namespace Database\Seeders;

use App\Models\ZodiacSign;
use Illuminate\Database\Seeder;

class ZodiacSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //12 signs
        $zodiacSigns = [
            'Aries', 'Taurus', 'Gemini', 'Cancer',
            'Leo', 'Virgo', 'Libra', 'Scorpio',
            'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
        ];
        foreach($zodiacSigns as $zodiacSign){
            ZodiacSign::create([
                'title' => $zodiacSign,
            ]);
        }
        //
        
    }
}
