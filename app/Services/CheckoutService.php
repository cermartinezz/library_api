<?php

namespace App\Services;

use App\Models\BookCopy;
use Illuminate\Database\Eloquent\Model;

class CheckoutService
{
    public static function create(BookCopy $copy, $days): Model
    {
        $start_date = now();
        $end_date   = now()->addDays($days);
        $user_id    = auth()->id();

        return $copy->checkouts()->create([
            'start_date' => $start_date,
            'end_date' => $end_date,
            'user_id' => $user_id
        ]);
    }
}
