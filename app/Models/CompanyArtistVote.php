<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyArtistVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'email',
    ];

    protected $with = [
        'companyArtist'
    ];

    public function companyArtist()
    {
        return $this->belongsTo(CompanyArtist::class);
    }
}
