<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email'
    ];

    public function companyToken() {
        return $this->hasOne(CompanyToken::class);
    }

    public function companyEntries() {
        return $this->hasMany(companyEntries::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Creating
        static::created(function ($model) {
            $model->companyToken()
                ->create(['token' => 'placeholder-token']);
        });
    }
}
