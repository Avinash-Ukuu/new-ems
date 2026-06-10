<?php

namespace App\Models;

use App\Models\Designation;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function designation():BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    public function manager():BelongsTo
    {
        return $this->belongsTo(Employee::class, 'reporting_manager_id');
    }

    public function subordinates():HasMany
    {
        return $this->hasMany(Employee::class, 'reporting_manager_id');
    }
}
