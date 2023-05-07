<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','author_id','genre_id'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function copies(): HasMany
    {
        return $this->hasMany(BookCopy::class,'book_id','id');
    }

    public function rentedCopies(): HasManyThrough
    {
        return $this->hasManyThrough(
            Checkout::class,
            BookCopy::class,
            'book_id',
            'book_copy_id',
            'id',
            'id'
        )->where('returned',0);
    }

    public function allCheckouts(): HasManyThrough
    {
        return $this->hasManyThrough(
            Checkout::class,
            BookCopy::class,
            'book_id',
            'book_copy_id',
            'id',
            'id'
        );
    }

    /**
     * Interact with the book's slug.
     *
     * @return Attribute
     */
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Str::slug($this->attributes['title'])
        );
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
