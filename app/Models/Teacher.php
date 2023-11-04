<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/teachers/' . $value),
        );
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }
}
