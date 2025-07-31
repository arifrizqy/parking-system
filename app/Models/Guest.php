<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'no_telp', 'needs'];

    public function vehicles(): MorphMany
    {
        return $this->morphMany(Vehicle::class, 'owner');
    }
}
