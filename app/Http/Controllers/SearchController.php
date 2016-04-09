<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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

    public function search(Request $request)
    {
        // Session::forget('selected');
        $selected = Session::get('selected', []);

        $videos = $this->vcRepo->whereIn('vc_id', $selected)->get();

        $result = Youtube::searchVideos($request->input('search'), 16, null, ['id', 'snippet']);

        $this->vcRepo->massCreate($result);

        return view('search.result', compact('result', 'selected', 'videos'));
    }

    public function add_video(Request $request)
    {
        Session::put('selected.' . $request->input('id'), $request->input('id'));

        return response()->json(['id' => $request->input('id')]);
    }

    public function remove_video(Request $request)
    {
        Session::forget('selected.'.$request->input('id'));

        return response()->json(['id' => $request->input('id')]);
    }

    public function get_selected()
    {
        $selected = Session::get('selected');

        $videos = $this->vcRepo->whereIn('vc_id', $selected)->get();
    }

    public function preview($id)
    {
        $video = $this->vcRepo->where('vc_id', $id)->first();
        // dd(serialize($video));

        return view('search.preview', compact('video'));
    }

}
