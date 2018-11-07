<?php

namespace App\Observers;

use App\Models\Hint;
use App\Models\News;

class HintObserver
{
    public function created(Hint $hint)
    {
        News::create([
            'title' => 'New Hints',
            'category' => 'Hint',
            'content' => 'Hint has ben added to challenges ' . $hint->challenge['name'],
        ]);
    }
}
