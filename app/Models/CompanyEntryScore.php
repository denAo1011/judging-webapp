<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEntryScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_token_id',
        'company_entry_id',
        'originality',
        'sustainability',
        'adaptability',
        'upliftment',
    ];

    public function companyToken() {
        return $this->belongsTo(CompanyToken::class);
    }

    public function companyEntry() {
        return $this->belongsTo(CompanyEntry::class);
    }
}
