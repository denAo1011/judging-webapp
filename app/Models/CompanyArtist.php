<?php

namespace App\Models;

use App\Traits\FileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanyArtist extends Model
{
    use FileUpload;
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'gender',
        'image'
    ];

    protected $appends = [
        'votes',
//        'unique_votes'
    ];

    protected $with = [
        'company'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function setImageAttribute($value)
    {
        if ($value != null && $value != '') {
            $fileName = 'artist-image-' . time() . '-' . Str::random(3);
            $imageUrl = $this->uploadBase64EncodedImage($value, $fileName, 'artist-images');
            $this->attributes['image'] = $imageUrl;
        }
    }

    public function companyArtistVotes()
    {
        return $this->hasMany(CompanyArtistVote::class);
    }

    public function UniqueVotesCount()
    {
        $votes = $this->companyArtistVotes()->get();
        $uniqueVotes = $votes->unique(function ($vote) {
            return $vote->email . '|' . $this->gender;
        });

        return $uniqueVotes->count();
    }

    public function getVotesAttribute()
    {
        return $this->companyArtistVotes()->count();
    }
//
//    public function getUniqueVotesAttribute()
//    {
//        $votes = $this->companyArtistVotes()->get();
//        $uniqueVotes = $votes->unique(function ($vote) {
//            return $vote->email . '|' . $this->gender;
//        });
//
//        return $uniqueVotes->count();
//    }
}
