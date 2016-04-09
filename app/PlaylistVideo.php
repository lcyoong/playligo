<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistVideo extends Model
{
    protected $table = 'playlist_videos';
    protected $primaryKey = 'plv_id';
    protected $fillable = ['plv_playlist', 'plv_video_id', 'plv_status', 'plv_order'];

    public function massCreate($playlist_id, $videos)
    {
        foreach ($videos as $video_id => $video) {
            $this->create(['plv_playlist' => $playlist_id, 'plv_video_id' => $video_id]);
        }
    }

    public function cache()
    {
        return $this->hasOne('App\VideoCache', 'vc_id', 'plv_video_id');
    }

}
