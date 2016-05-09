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

    public static function boot()
    {
        parent::boot();
        static::saved(function($post)
        {
            $repoPl = new Playlist;

            $rating = $repoPl->updateRating($post->plr_playlist);
        });
    }

}
