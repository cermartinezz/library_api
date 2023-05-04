<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookCopy extends Model
{
    use HasFactory;

    protected $fillable = ['book_id','published_year','publisher'];

    public function checkouts(): HasMany
    {
        return $this->hasMany(Checkout::class,'book_copy_id','id');
    }
}
