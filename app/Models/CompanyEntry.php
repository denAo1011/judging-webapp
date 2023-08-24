<?php

namespace App\Models;

use App\Traits\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanyEntry extends Model
{
    use FileUpload;
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
        'notes',
        'payment_reference',
        'payment_reference_number',
    ];

    protected $casts = [
        'day_of_airing' => 'array'
    ];

    public function setPaymentReferenceAttribute($value)
    {
        if ($value != null && $value != '') {
            $fileName = 'payment-references-' . time() . '-' . Str::random(3);
            $imageUrl = $this->uploadBase64EncodedImage($value, $fileName, 'payment-referencess');
            $this->attributes['payment_reference'] = $imageUrl;
        }
    }

    // RELATIONS

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function companyEntryScores()
    {
        return $this->hasMany(CompanyEntryScore::class);
    }

    // SCOPES

    public function scopeOrderByAverageLevelOneRating($query, $direction = 'desc')
    {
        return $query->withAvg('companyEntryScores', 'level_one_rating')
            ->orderBy('companyEntryScores_avg_level_one_rating', $direction);
    }

    public function scopeOrderByAverageLevelTwoRating($query, $direction = 'desc')
    {
        return $query->withAvg('companyEntryScores', 'level_two_rating')
            ->orderBy('companyEntryScores_avg_level_two_rating', $direction);
    }
}
