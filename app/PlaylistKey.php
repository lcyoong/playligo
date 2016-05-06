<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistKey extends Model
{
  protected $table = 'playlist_keys';
  protected $primaryKey = 'plk_id';
  protected $fillable = ['plk_playlist', 'plk_key', 'plk_weight', 'plk_next_token'];

}
