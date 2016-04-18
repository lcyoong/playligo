<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class PollPlaylist extends Model
{
    use ModelTrait;
    protected $table = 'poll_playlists';
    protected $primaryKey = 'polp_id';
    protected $fillable = ['polp_playlist', 'polp_poll', 'polp_status', 'polp_order'];

    public function scopeWithPlaylist($query)
    {
        $query->join('playlists', 'pl_id', '=', 'polp_playlist')
              ->leftJoin('playlist_videos', 'plv_playlist', '=', 'pl_id')->groupBy('plv_playlist')
              ->leftJoin('video_caches', 'plv_video_id', '=', 'vc_id');
    }

    public function reorder($id, $pol_id, $start_pos, $end_pos)
    {
        DB::beginTransaction();
        DB::statement("set @x = 0; ");
        DB::update("UPDATE poll_playlists SET polp_order = (@x:=@x+1) where polp_poll = $pol_id ORDER BY polp_order, polp_id;");
        if ($start_pos < $end_pos) {
            $this->where('polp_poll', '=', $pol_id)->where('polp_order', '>', $start_pos)->where('polp_order', '<=', $end_pos)->decrement('polp_order');
        } else {
            $this->where('polp_poll', '=', $pol_id)->where('polp_order', '<', $start_pos)->where('polp_order', '>=', $end_pos)->increment('polp_order');
        }
        $this->where('polp_id', '=', $id)->update(['polp_order' => $end_pos]);
        DB::commit();
    }

    public function addVote($polp_id)
    {
        return $this->find($polp_id)->increment('polp_vote');
    }

}
