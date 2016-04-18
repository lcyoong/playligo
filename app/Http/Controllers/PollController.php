<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Poll;
use App\PollPlaylist;
use App\Playlist;
use App\Http\Requests\CreatePoll;
use App\Http\Requests\EditPoll;

class PollController extends Controller
{
    protected $polRepo;
    protected $polpRepo;

    public function __construct(Poll $polRepo, PollPlaylist $polpRepo)
    {
        $this->polRepo = $polRepo;
        $this->polpRepo = $polpRepo;        
    }

    public function index(Request $request)
    {
        $polls = $this->polRepo->filterOwner($request->user()->id)->getPaginated();

        return view('poll.list', compact('polls'));
    }

    public function create()
    {
        return view('poll.create');
    }

    public function store(CreatePoll $request)
    {
      $input = $request->all();

      // $input['pol_user'] = auth()->user()->id;

      $this->polRepo->create($input);

      return redirect('poll')->with('status', trans('messages.store_successful'));
    }

    public function store_add(Request $request)
    {
        $input = $request->input();

        $poll = $this->polRepo->create(['pol_title' => $input['pol_title'], 'pol_user'=> auth()->user()->id]);

        if ($poll->pol_id > 0) {
            $input_polp = ['polp_playlist' => $input['pol_playlist'],'polp_poll' => $poll->pol_id];

            $this->polpRepo->create($input_polp);
        }

        return redirect('poll/successful/'.$poll->pol_id)->with('status', trans('messages.poll_create_add_successful'));
    }

    public function successful(Poll $poll)
    {
        return view('poll.successful', compact('poll'));
    }

    public function delete(Poll $poll)
    {
        return view('poll.delete', compact('poll'));
    }

    public function destroy(Request $request)
    {
        $this->polRepo->find($request->input('pol_id'))->delete();

        return back()->with('status', trans('messages.delete_successful'));
    }

    public function addPlaylist(Playlist $playlist)
    {
        $dd_polls = $this->polRepo->filterActive()->toDropDown('pol_id', 'pol_title');

        return view('poll.add_playlist', compact('playlist', 'dd_polls'));
    }

    public function storePlaylist(Request $request)
    {
        $input = $request->input();

        $this->polpRepo->create($input);

        return redirect('poll/successful/'.$input['polp_poll'])->with('status', trans('messages.poll_add_successful'));
    }

    public function edit(Poll $poll)
    {
        return view('poll.edit', compact('poll'));
    }

    public function update(EditPoll $request)
    {
        $input = $request->all();

        $this->polRepo->find($request->input('pol_id'))->update($input);

        return redirect()->back()->with('status', trans('messages.store_successful'));
    }

    public function sortItem(Request $request)
  	{
          $input = $request->input();

  		    $this->polpRepo->reorder($input['id'], $input['pol_id'], $input['start_pos'], $input['end_pos']);
  	}

}
