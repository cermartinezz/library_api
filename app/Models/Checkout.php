<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
