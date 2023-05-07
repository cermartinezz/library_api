<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookCopy extends Model
{
    use HasFactory;

    protected $fillable = ['book_id','published_year','publisher'];

    public function checkouts(): HasMany
    {
        return $this->hasMany(Checkout::class,'book_copy_id','id');
    }

    /**
     * @return BelongsTo
     */
    public function book(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
