<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Interact with the author's slug.
     *
     * @return Attribute
     */
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Str::slug($this->attributes['name'])
        );
    }
}
