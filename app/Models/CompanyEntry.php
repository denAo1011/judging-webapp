<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'email',
        'link',
        'title',
        'premiere_date',
        'day_of_airing',
        'time_of_airing',
        'production_company',
        'producers',
        'executive_producers',
        'directors',
        'writers',
        'synopsis',
        'contact_person',
        'contact_person_email',
        'contact_person_number',
        'status',
        'notes'
    ];

    protected $appends = [
        'score'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function companyEntryScores()
    {
        return $this->hasMany(CompanyEntryScore::class);
    }

    public function getScoreAttribute()
    {
        return $this->companyEntryScores()
            ->avg('total');
    }
}
