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
    protected $fillable = ['pl_user', 'pl_description', 'pl_status'];

    public function videos()
    {
        return $this->hasMany('App\PlaylistVideo', 'plv_playlist', 'pl_id');
    }
}
