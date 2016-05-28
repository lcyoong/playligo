<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\PlaylistVideo;
use App\VideoCache;

use App\Http\Requests;

class JobController extends Controller
{
    public function updateSnippet()
    {
      $plvlist = PlaylistVideo::whereNull('plv_snippet')->get();

      foreach ($plvlist as $plv) {
        $plv->update(['plv_snippet' => VideoCache::find($plv->plv_video_id)->vc_snippet]);
      }
    }

    public function updatePlThumb()
    {
      $plvlist = PlaylistVideo::whereNull('plv_snippet')->get();

      foreach ($plvlist as $plv) {
        $plv->update(['plv_snippet' => VideoCache::find($plv->plv_video_id)->vc_snippet]);
      }
    }

}
