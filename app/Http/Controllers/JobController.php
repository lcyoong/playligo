<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\PlaylistVideo;
use App\VideoCache;
use App\Poll;

use App\Http\Requests;

class JobController extends Controller
{
    public function updateSnippet()
    {
      $plvlist = PlaylistVideo::where('plv_snippet', '=', '')->get();

      echo $plvlist->count();

      foreach ($plvlist as $plv) {
        echo $plv->update(['plv_snippet' => VideoCache::find($plv->plv_video_id)->vc_snippet]);
      }
    }

    public function updatePlThumb()
    {
      $pllist = Playlist::whereNull('pl_thumb_path')->join('playlist_videos', 'plv_playlist', '=', 'pl_id')->groupBy('plv_playlist')->get();

      echo $pllist->count();

      foreach ($pllist as $pl) {
        echo $pl->update(['pl_thumb_path' => unserialize($pl->plv_snippet)->thumbnails->medium->url]);
      }
    }

    public function updatePollPlaylistCount()
    {
      $polls = Poll::get();

      echo $polls->count();

      foreach ($polls as $poll) {
        echo $poll->updatePlaylistCount($poll->pol_id);
      }
    }

}
