<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }
}
