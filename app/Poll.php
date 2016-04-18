<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use App\PollPlaylist;

class Poll extends Model
{
  use ModelTrait;

  protected $table = 'polls';
  protected $primaryKey = 'pol_id';
  protected $fillable = ['pol_user', 'pol_title', 'pol_description', 'pol_status'];

  public function playlists()
  {
      return $this->hasMany('App\PollPlaylist', 'polp_poll', 'pol_id')->withPlaylist()->orderBy('polp_order', 'asc');
  }

  public function scopeFilterOwner($query, $owner = null)
  {
      if (!is_null($owner)) {
          $query->where('pol_user', '=', $owner);
      }
  }

  public function scopeFilterActive($query)
  {
      $query->where('pol_status', '=', 'active');
  }

}
