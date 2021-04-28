<?php

namespace Database\Seeders;

use App\Models\ScoreComment;
use Illuminate\Database\Seeder;

class ScoreCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //12 signs
        $comments = [
            'Really Shitty', 'Shitty', 'Below Average', 
            'Average', 'Better than Average', 'Normal', 
            'Good', 'Really Good', 'Amazing', 'Super Amazing'
        ];

        $counter = 0;
        foreach($comments as $comment){
            $counter++;

            ScoreComment::create([
                'score_comment' => "$comment Day",
                'score_value' => $counter,
            ]);
        }
    }
}
