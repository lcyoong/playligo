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
    protected $fillable = ['pl_user', 'pl_title', 'pl_description', 'pl_status'];

    public function videos()
    {
        return $this->hasMany('App\PlaylistVideo', 'plv_playlist', 'pl_id')->orderBy('plv_order', 'asc');
    }

    public function scopeFilterOwner($query, $owner = null)
    {
        if (!is_null($owner)) {
            $query->where('pl_user', '=', $owner);
        }
    }

}
