<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function image(): Attribute
    {
        return Attribute::make(
            get:fn($value) => asset('/storage/photos/' . $value),
        );
    }
}
