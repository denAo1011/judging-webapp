<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'email',
        'firstname',
        'lastname',
        'contact',
        'position',
        'status',
        'notes'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
