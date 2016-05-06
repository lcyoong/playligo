<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SearchLocation;
use Youtube;
use App\VideoCache;
use App\Playlist;
use App\PlaylistVideo;
use App\PlaylistKey;
use Auth;
use Session;

class SearchController extends Controller
{
    //
    protected $vcRepo;

    public function __construct(VideoCache $vcRepo)
    {
        $this->vcRepo = $vcRepo;
    }

    public function index()
    {
        return view('search.search');
    }

    public function searchKeywords(SearchLocation $request)
    {
        session()->put('search_location', ucwords($request->input('location')));

        $location = session()->get('search_location');

        return view('search.search_keywords', compact('location'));
    }

    public function autoGen(Request $request)
    {
        $keys = $request->input('search_key');

        $location = session()->get('search_location');

        $resultsets = $this->fetchVideos($location, $keys, false, 0.5, true, $keys_used);

        $default_playlist_title = $location . ' ' . implode(' , ', array_column($keys_used, 'value')) . ' video playlist by ' . auth()->user()->name;

        $auto_playlist = $this->autoGenPlaylist($resultsets);

        // Create playlist
        $playlist = Playlist::create(['pl_user' => Auth::user()->id, 'pl_title' => $default_playlist_title, 'pl_location' => $location]);

        // Create playlist videos
        $plv = new PlaylistVideo;

        $plv->massCreate($playlist->pl_id, session()->get('selected', []));

        // Create playlist keys
        $plk = new PlaylistKey;

        foreach ($keys_used as $key_used) {
          $plk->create(['plk_playlist' => $playlist->pl_id, 'plk_key' => $key_used['value'], 'plk_weight'=> $key_used['weight'], 'plk_next_token'=> $key_used['next_token']]);
        }

        return view('search.auto_playlist', compact('resultsets', 'location', 'default_playlist_title', 'auto_playlist', 'playlist'));
    }

    public function editPlaylist(Playlist $playlist)
    {
        // $keys = $request->input('search_key');

        // $location = $playlist->pl_location;

        $selected = array_column($playlist->videos->toArray(), 'plv_video_id');

        $keys = array_column($playlist->keys->toArray(), 'plk_key');

        // $videos = $this->vcRepo->whereIn('vc_id', $selected)->get();

        $resultsets = $this->fetchVideos($playlist->pl_location, $keys, false, 1, true, $keys_used);

        // foreach ($keys_used as $key => $value) {
        //     $query_str[$value] = "location=" . $location . "&search_key[$key]=$value";
        // }

        // $default_playlist_title = $location . ' ' . implode(' , ', $keys_used) . ' video playlist by ' . auth()->user()->name;

        return view('search.edit_playlist', compact('playlist', 'selected', 'keys', 'resultsets'));
    }

    public function editPlaylistMore(Playlist $playlist, Request $request)
    {
        $keys[] = $request->input('search_key');

        // $location = $playlist->pl_location;

        $selected = array_column($playlist->videos->toArray(), 'plv_video_id');

        $resultsets = $this->fetchVideos($playlist->pl_location, $keys, false, 1, false);

        return view('search.more_result', compact('resultsets', 'selected', 'playlist'));
    }


    public function results(Request $request)
    {
        $keys = $request->input('search_key');

        $location = session()->get('search_location');

        $selected = session()->get('selected', []);

        $videos = $this->vcRepo->whereIn('vc_id', $selected)->get();

        session()->forget('search_keywords');

        $resultsets = $this->fetchVideos($location, $keys, false, 1, true, $keys_used);

        foreach ($keys_used as $key => $value) {
            $query_str[$value] = "location=" . $location . "&search_key[$key]=$value";
        }

        $default_playlist_title = $location . ' ' . implode(' , ', $keys_used) . ' video playlist by ' . auth()->user()->name;

        return view('search.result', compact('resultsets', 'selected', 'videos', 'location', 'default_playlist_title', 'query_str'));
    }

    public function fetchVideos($location, $keys, $more = false, $result_multiplier = 1, $use_default = true, &$keys_used = [])
    {
        $result = [];

        $keys = array_filter($keys);

        // User keywords
        foreach ($keys as $key) {
            if (!empty($key)) {
                // $result = array_merge($result, $this->fetchVideosByKeyword($location, $key, config('youtube.user_key_weight'), $more));
                $key_result = $this->fetchVideosByKeyword($location, $key, $result_multiplier * config('youtube.user_key_weight'), $more);

                $result[$key] = $key_result['results'];

                $keys_used[] = ['value'=>$key, 'weight'=>1, 'next_token' => $key_result['info']['nextPageToken']];
            }
        }

        // Generic keywords
        if (count($keys) < config('youtube.key_quota') && $use_default) {

            $generic_keys = array_slice(config('youtube.generic_keywords'), 0, config('youtube.key_quota') - count($keys));

            foreach ($generic_keys as $key) {
                if (!empty($key)) {
                    // $result = array_merge($result, $this->fetchVideosByKeyword($location, $key, config('youtube.generic_key_weight'), $more));
                    $key_result = $this->fetchVideosByKeyword($location, $key, $result_multiplier * config('youtube.generic_key_weight'), $more);

                    $result[$key] = $key_result['results'];

                    $keys_used[] = ['value'=>$key, 'weight'=>0.5, 'next_token' => $key_result['info']['nextPageToken']];
                }
            }
        }

        $this->vcRepo->massCreate($result);

        return $result;
    }

    protected function fetchVideosByKeyword($location, $key, $max_result, $more)
    {
        if (!empty($key)) {
            $params = [ 'q'=>$location . ' ' . $key,
                  'type'=>'video',
                  'part'=>'id, snippet',
                  'videoDuration' => 'short',
                  'maxResults'=>$max_result];

            if ($more) {
                $info = session()->get('search_keywords.' . $key);
                $params['pageToken'] = $info['nextPageToken'];
            }

            $key_result = Youtube::searchAdvanced($params, true);

            session()->put('search_keywords.' . $key, $key_result['info']);

            // return array_values($key_result['results']);
            return array_values($key_result);
        }
    }

    public function resultsMore(Request $request)
    {
        $keys = $request->input('search_key');

        $location = session()->get('search_location');

        $selected = session()->get('selected', []);

        $resultsets = $this->fetchVideos($location, $keys, true, 1, false);

        return view('search.more_result', compact('resultsets', 'selected'));
    }

    public function add_video(Request $request)
    {
        // Session::put('selected.' . $request->input('id'), $request->input('id'));
        session()->push('selected', $request->input('id'));

        return response()->json(['id' => $request->input('id')]);
    }

    public function remove_video(Request $request)
    {
        $key = array_search($request->input('id'), session()->get('selected'));

        Session::forget('selected.' . $key);

        return response()->json(['id' => $request->input('id')]);
    }

    public function getSelected(Playlist $playlist)
    {
        // $videos = [];
        //
        // session()->put('selected', array_values(Session::get('selected')));
        //
        // $selected = session()->get('selected');
        //
        // $vcvideos = $this->vcRepo->whereIn('vc_id', $selected)->get();
        //
        // foreach ($vcvideos as $video) {
        //   $key = array_search($video->vc_id, $selected);
        //
        //   $videos[$key] = $video;
        // }
        //
        // ksort($videos);
        $videos = $playlist->videos;

        return view('search.selected_videos', compact('videos'));
    }

    // public function getSelected()
    // {
    //     $videos = [];
    //
    //     session()->put('selected', array_values(Session::get('selected')));
    //
    //     $selected = session()->get('selected');
    //
    //     $vcvideos = $this->vcRepo->whereIn('vc_id', $selected)->get();
    //
    //     foreach ($vcvideos as $video) {
    //       $key = array_search($video->vc_id, $selected);
    //
    //       $videos[$key] = $video;
    //     }
    //
    //     ksort($videos);
    //
    //     return view('search.selected_videos', compact('videos'));
    // }

    public function sortSelected(Request $request)
    {
        $selected = Session::get('selected');

        $start_pos = $request->input('start_pos');

        $end_pos = $request->input('end_pos');

        $this->moveElement($selected, $start_pos, $end_pos);

        Session::put('selected', $selected);

    }

    public function preview($id)
    {
        $video = $this->vcRepo->where('vc_id', $id)->first();

        $snippet = unserialize($video->vc_snippet);

        return view('search.preview', compact('video', 'snippet'));
    }

    private function moveElement(&$array, $a, $b) {

        $out = array_splice($array, $a, 1);

        array_splice($array, $b, 0, $out);

    }

    private function autoGenPlaylist($resultsets)
    {
      $playlist = [];

      session()->forget('selected');

      foreach($resultsets as $set) {
        foreach ($set as $video) {
          $playlist[] = $video;

          session()->push('selected', $video->id->videoId);
        }
      }

      return $playlist;

    }
}
