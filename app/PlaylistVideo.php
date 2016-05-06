<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PlaylistVideo extends Model
{
    protected $table = 'playlist_videos';
    protected $primaryKey = 'plv_id';
    protected $fillable = ['plv_playlist', 'plv_video_id', 'plv_status', 'plv_order'];

    public function massCreate($playlist_id, $videos)
    {
        foreach ($videos as $key => $video_id) {
            $this->create(['plv_playlist' => $playlist_id,
                            'plv_video_id' => $video_id,
                            // 'plv_order' => $key
                          ]);
        }
    }

    public function cache()
    {
        return $this->hasOne('App\VideoCache', 'vc_id', 'plv_video_id');
    }

    public function reorder($id, $pl_id, $start_pos, $end_pos)
    {
        DB::beginTransaction();
        DB::statement("set @x = 0; ");
        DB::update("UPDATE playlist_videos SET plv_order = (@x:=@x+1) where plv_playlist = $pl_id ORDER BY plv_order, plv_id;");
        if ($start_pos < $end_pos) {
            $this->where('plv_playlist', '=', $pl_id)->where('plv_order', '>', $start_pos)->where('plv_order', '<=', $end_pos)->decrement('plv_order');
        } else {
            $this->where('plv_playlist', '=', $pl_id)->where('plv_order', '<', $start_pos)->where('plv_order', '>=', $end_pos)->increment('plv_order');
        }
        $this->where('plv_id', '=', $id)->update(['plv_order' => $end_pos]);
        DB::commit();
    }

    private function lastOrder($pl_id)
    {
        return $this->where('plv_playlist', '=', $pl_id)->max('plv_order') + 1;
    }

    public static function boot()
    {
        PlaylistVideo::creating(function ($post) {
          $post['plv_order'] = $post->lastOrder($post['plv_playlist']);
        });
    }
}
