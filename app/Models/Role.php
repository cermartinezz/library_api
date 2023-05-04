<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const STUDENT = 1;
    public const LIBRARIAN = 2;

    protected $fillable = [
        'name'
    ];
}
