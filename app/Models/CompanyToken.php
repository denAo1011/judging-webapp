<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanyToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'value',
        'used_at',
        'tallies'
    ];

    protected $casts = [
        'tallies' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function companyEntryScores()
    {
        return $this->hasMany(CompanyEntryScore::class);
    }

    protected static function boot()
    {
        parent::boot();

        // On create generate token
        static::creating(function ($model) {
            do {
                // generate a random string using Laravel's str_random helper
                $random = Str::random(10);
            } // check if the token already exists and if it does, try again
            while (CompanyToken::where('value', $random)->exists());

            $model->value = $random;
        });

        // On update regenerate token
        static::updating(function ($model) {
            do {
                // generate a random string using Laravel's str_random helper
                $random = Str::random(10);
            } // check if the token already exists and if it does, try again
            while (CompanyToken::where('value', $random)->exists());

            $model->value = $random;
        });
    }
}
