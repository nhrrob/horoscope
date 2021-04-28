<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZodiacSignScore extends Model
{
    protected $guarded = ['id'];

    protected $table = 'zodiac_sign_scores';

    public function zodiacSign()
    {
        return $this->belongsTo(ZodiacSign::class, 'zodiac_sign_id');
    }

    public function scoreComment()
    {
        return $this->belongsTo(ScoreComment::class, 'score');
    }


}
