<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function scopeByContinent($query, $continent)
    {
      return $query->join('countries', 'coun_code', '=', 'cit_country')
                  ->where('cit_hotels', '>=', config('playligo.min_significant_hotel'))
                  ->where('coun_continent', '=', $continent)->orderBy('cit_hotels', 'desc');
    }

    public function scopeByRegion($query, $region)
    {
      $query->join('countries', 'coun_code', '=', 'cit_country')
                  ->where('cit_hotels', '>=', config('playligo.min_significant_hotel'))
                  ->where('coun_region', '=', $region)->orderBy('cit_hotels', 'desc');
    }

}
