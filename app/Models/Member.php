<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'nisn', 'name', 'type'];

    public function vehicles(): MorphMany
    {
        return $this->morphMany(Vehicle::class, 'owner');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
