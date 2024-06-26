<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the registrations for the bootcamp.
     */
    public function registrations()
    {
        return $this->hasMany(BootcampRegistered::class);
    }
}
