<?php

namespace App\Observers;

use App\Models\Challenge;
use App\Models\News;

class ChallengeObserver
{
    public function created(Challenge $challenge)
    {
        News::create([
            'title' => 'New Challenges',
            'category' => 'Challenge',
            'content' => $challenge['name'] . ' has ben added',
        ]);
    }
}
