<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'book_copy_id',
        'user_id',
        'returned',
    ];

    public function copy(): BelongsTo
    {
        return $this->belongsTo(BookCopy::class,'book_copy_id','id','checkouts');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id','checkouts');
    }
}
