<?php

namespace App;

use Carbon\Carbon;

function applyPublishedCriteria($query)
{
    $now = Carbon::now()->toDateTimeString();

    return $query
        ->where('published', 1)
        ->where(function($q) use ($now) {
            $q->whereDate('publish_start_date', '<=', $now)
              ->orWhereNull('publish_start_date');
        })
        ->where(function($q) use ($now) {
            $q->whereDate('publish_end_date', '>=', $now)
              ->orWhereNull('publish_end_date');
        });
}
