<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'value'
    ];

    // Get value by key
    public static function getValue($key)
    {
        return self::all()->where('key', $key)->first()->value ?? NULL;
    }

    // Determine if date now is within range of either level one or level two voting,
    // return the level of voting, else return NULL
    public static function getLevelOfVoting()
    {
        $now = now();

        $levelOneVotingFrom = self::getValue('level_one_voting_from');
        $levelOneVotingTo = self::getValue('level_one_voting_to');
        $levelTwoVotingFrom = self::getValue('level_two_voting_from');
        $levelTwoVotingTo = self::getValue('level_two_voting_to');

        if ($now->between($levelOneVotingFrom, $levelOneVotingTo)) {
            return 'LEVEL_ONE';
        } else if ($now->between($levelTwoVotingFrom, $levelTwoVotingTo)) {
            return 'LEVEL_TWO';
        } else {
            return NULL;
        }
    }

    //Determine if date now is within range of submission date
    // return boolean
    public static function getSubmissionDate(): bool
    {
        $now = now();

        $submissionDateFrom = self::getValue('submission_date_from');
        $submissionDateTo = self::getValue('submission_date_to');

        if ($now->between($submissionDateFrom, $submissionDateTo)) {
            return true;
        } else {
            return false;
        }
    }

    //Determine if date now is within range of submission date
    // return boolean
    public static function getVotingDate(): bool
    {
        $now = now();

        $votingDateFrom = self::getValue('voting_date_from');
        $votingDateTo = self::getValue('voting_date_to');

        if ($now->between($votingDateFrom, $votingDateTo)) {
            return true;
        } else {
            return false;
        }
    }
}
