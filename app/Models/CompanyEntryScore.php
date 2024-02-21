<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEntryScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_juror_id',
        'company_entry_id',
        'level_one_rating',
        'level_two_rating',
    ];

    public function companyJuror() {
        return $this->belongsTo(CompanyJuror::class);
    }

    public function companyEntry() {
        return $this->belongsTo(CompanyEntry::class);
    }
}
