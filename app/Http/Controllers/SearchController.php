<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SearchLocation;
use Youtube;
use App\VideoCache;
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
        session()->put('search_location', $request->input('location'));

        $location = session()->get('search_location');

        return view('search.search_keywords', compact('location'));
    }

    public function results(Request $request)
    {
        $keys = $request->input('search_key');

        $location = session()->get('search_location');

        $selected = session()->get('selected', []);

        $videos = $this->vcRepo->whereIn('vc_id', $selected)->get();

        session()->forget('search_keywords');

        $result = $this->fetchVideos($location, $keys, false, $keys_used);

        $default_playlist_title = $location . ' ' . implode(' , ', $keys_used) . ' video playlist by ' . auth()->user()->name;

        return view('search.result', compact('result', 'selected', 'videos', 'location', 'default_playlist_title'));

        // return redirect->route('results');
    }

    public function fetchVideos($location, $keys, $more = false, &$keys_used = [])
    {
        $result = [];

        $keys = array_filter($keys);

        // User keywords
        foreach ($keys as $key) {
            if (!empty($key)) {
                $result = array_merge($result, $this->fetchVideosByKeyword($location, $key, config('youtube.user_key_weight'), $more));
                $keys_used[] = $key;
            }
        }

        // Generic keywords
        if (count($keys) < config('youtube.key_quota')) {

            $generic_keys = array_slice(config('youtube.generic_keywords'), 0, config('youtube.key_quota') - count($keys));

            foreach ($generic_keys as $key) {
                if (!empty($key)) {
                    $result = array_merge($result, $this->fetchVideosByKeyword($location, $key, config('youtube.generic_key_weight'), $more));
                    $keys_used[] = $key;
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

            return array_values($key_result['results']);
        }
    }

    public function resultsMore(Request $request)
    {
        $keys = $request->input('search_key');

        $location = session()->get('search_location');

        $selected = session()->get('selected', []);

        $result = $this->fetchVideos($location, $keys, true);

        return view('search.more_result', compact('result', 'selected'));
    }

    public function add_video(Request $request)
    {
        // Session::put('selected.' . $request->input('id'), $request->input('id'));
        Session::push('selected', $request->input('id'));

        return response()->json(['id' => $request->input('id')]);
    }

    public function remove_video(Request $request)
    {
        $key = array_search($request->input('id'), session()->get('selected'));

        Session::forget('selected.' . $key);

        return response()->json(['id' => $request->input('id')]);
    }

    public function getSelected()
    {
        $videos = [];

        Session::put('selected', array_values(Session::get('selected')));

        $selected = Session::get('selected');

        $vcvideos = $this->vcRepo->whereIn('vc_id', $selected)->get();

        foreach ($vcvideos as $video) {
          $key = array_search($video->vc_id, $selected);

          $videos[$key] = $video;
        }

        ksort($videos);

        return view('search.selected_videos', compact('videos'));
    }

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
}
