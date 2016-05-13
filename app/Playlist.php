<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;
use App\PlaylistVideo;

class Playlist extends Model
{
    use ModelTrait;

    protected $table = 'playlists';
    protected $primaryKey = 'pl_id';
    protected $fillable = ['pl_user', 'pl_title', 'pl_description', 'pl_status', 'pl_location', 'pl_rating', 'pl_rating_count'];

    public function videos()
    {
        return $this->hasMany('App\PlaylistVideo', 'plv_playlist', 'pl_id')->leftJoin('video_caches', 'vc_id', '=', 'plv_video_id')->orderBy('plv_order', 'asc');
    }

    public function keys()
    {
        return $this->hasMany('App\PlaylistKey', 'plk_playlist', 'pl_id');
    }

    public function scopeFilter($query, $filter = [])
    {
        if (array_get($filter, 'pl_title')) {
            $query->where('pl_title', 'like', '%' . $filter['pl_title'] . '%');
        }
        if (array_get($filter, 'pl_user')) {
            $query->where('name', 'like', '%' . $filter['pl_user'] . '%');
        }
    }

    public function scopeFilterOwner($query, $owner = null)
    {
        if (!is_null($owner)) {
            $query->where('pl_user', '=', $owner);
        }
    }

    public function scopeWithPicture($query)
    {
        return $query->leftJoin('playlist_videos', 'plv_playlist', '=', 'pl_id')->groupBy('plv_playlist');
    }

    public function scopeWithOwner($query)
    {
        return $query->addSelect('name', 'email')->join('users', 'id', '=', 'pl_user');
    }

    public function updateRating($pl_id)
    {
        $repoPlr = new PlaylistRating;

        return $this->find($pl_id)->update(['pl_rating'=>$repoPlr->latestRating($pl_id), 'pl_rating_count'=> $repoPlr->latestCount($pl_id)]);
    }

}
