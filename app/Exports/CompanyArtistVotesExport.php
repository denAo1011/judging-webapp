<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyArtistVotesExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return CompanyArtist::leftJoin('company_artist_votes', 'company_artist_votes.company_artist_id', 'company_artists.id')
            ->select('company_artists.name', 'company_artists.gender', 'company_artist_votes.email', 'company_artist_votes.ip_address', 'company_artist_votes.user_agent');
    }

    public function headings(): array
    {
        return [
            'name',
            'gender',
            'email',
            'ip_address',
            'user_agent',
        ];
    }
}
