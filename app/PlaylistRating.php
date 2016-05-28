<?php

namespace App;

use App\Playlist;

use Illuminate\Database\Eloquent\Model;

class PlaylistRating extends Model
{
    protected $fillable = ['plr_playlist', 'plr_user', 'plr_rating', 'plr_status'];

    public function latestRating($pl_id)
    {
        return $this->where('plr_playlist', '=', $pl_id)->where('plr_status', '=', 'active')->avg('plr_rating');
    }

    public function latestCount($pl_id)
    {
        return $this->where('plr_playlist', '=', $pl_id)->where('plr_status', '=', 'active')->count('plr_id');
    }

    public function myRating($pl_id, $user_id)
    {
      $rating = $this->where('plr_playlist', '=', $pl_id)->where('plr_user', '=', $user_id)->first(['plr_rating']);

      return $rating ? $rating->plr_rating : 0;
    }

    public function clear($pl_id, $user_id)
    {
      return  $this->where('plr_playlist', '=', $pl_id)->where('plr_user', '=', $user_id)->delete();
    }

    public static function boot()
    {
        parent::boot();
        static::saved(function($post)
        {
            $repoPl = new Playlist;

            $repoPl->updateRating($post->plr_playlist);
        });
    }

}
