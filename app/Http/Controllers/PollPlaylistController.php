<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Poll;
use App\PollPlaylist;
use App\Playlist;
use App\Http\Requests\AddPollPlaylist;

class PollPlaylistController extends Controller
{
    protected $polRepo;
    protected $polpRepo;

    public function __construct(Poll $polRepo, PollPlaylist $polpRepo)
    {
        $this->polRepo = $polRepo;
        $this->polpRepo = $polpRepo;
    }

    public function store(AddPollPlaylist $request)
    {
        $input = $request->all();

        $this->polpRepo->create($input);

        return redirect()->back()->with('status', trans('messages.store_successful'));
    }

    public function delete(PollPlaylist $playlist)
    {
        return view('pollplaylist.delete', compact('playlist'));
    }

    public function destroy(Request $request)
    {
        $this->polpRepo->find($request->input('plop_id'))->delete();

        return back()->with('status', trans('messages.delete_successful'));
    }

    public function storeVote(PollPlaylist $playlist)
    {
        session()->flash('status', trans('messages.vote_successful'));

        return $this->polpRepo->addVote($playlist->polp_id);
        // return back()->with('status', trans('messages.vote_successful'));
    }

}
