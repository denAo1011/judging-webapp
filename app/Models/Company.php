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

    public function companyJurors()
    {
        return $this->hasMany(CompanyJuror::class);
    }

    public function companyEntries()
    {
        return $this->hasMany(CompanyEntry::class);
    }
}
