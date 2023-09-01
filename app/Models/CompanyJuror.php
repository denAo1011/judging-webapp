<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanyJuror extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'position',
        'token',
        'is_current',
        'voted_at',
        'tallies'
    ];

    protected $casts = [
        'tallies' => 'array'
    ];

    protected $with = [
        'company'
    ];

    // Get owning company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected static function boot()
    {
        parent::boot();

        // On create generate token
        static::creating(function ($model) {
            do {
                // generate a random string using Laravel's str_random helper
                $random = Str::random(10);
                $random .= "ANAKTV";
                $random = strtoupper($random);
            } // check if the token already exists and if it does, try again
            while (CompanyJuror::where('token', $random)->exists());

            $model->token = $random;
        });
    }
}
