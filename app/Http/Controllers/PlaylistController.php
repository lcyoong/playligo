<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PlayList;
use App\PlaylistVideo;
use Auth;
use Session;

class PlaylistController extends Controller
{
    protected $plRepo;
    protected $plvRepo;

    public function __construct(PlayList $plRepo, PlaylistVideo $plvRepo)
    {
        $this->plRepo = $plRepo;
        $this->plvRepo = $plvRepo;
    }

    public function index()
    {
        $playlists = $this->plRepo->getPaginated();

        return view('playlist.list', compact('playlists'));
    }

    public function store(Request $request)
    {
        $playlist = $this->plRepo->create(['pl_user' => Auth::user()->id, 'pl_description' => $request->input('pl_description')]);

        $this->plvRepo->massCreate($playlist->pl_id, Session::get('selected', []));

        Session::forget('selected');

        return back()->with('status', trans('messages.playlist_create_successful'));
    }

    public function delete(PlayList $playlist)
    {
        return view('playlist.delete', compact('playlist'));
    }

    public function destroy(Request $request)
    {
        $this->plRepo->find($request->input('pl_id'))->delete();

        return back()->with('status', trans('messages.delete_successful'));
    }

    public function edit(PlayList $playlist)
    {
        // $this->authorize('update', $prop);

        return view('playlist.edit', compact('playlist'));
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $this->propertyRepo->find($request->input('pl_id'))->update($input);

        return redirect()->back()->with('status', trans('common.save_successful'));
    }

}
