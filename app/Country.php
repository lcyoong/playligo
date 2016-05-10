<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Country extends Model
{
    public function continents()
    {
      return $this->select(DB::raw('count(cit_id) as city_count, coun_continent'))->join('cities', 'cit_country', '=', 'coun_code')
              ->where('cit_hotels', '>=', config('playligo.min_significant_hotel'))
              ->groupBy('coun_continent')->get();
    }
}
