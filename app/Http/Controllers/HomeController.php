<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Poll;
use App\Playlist;
use App\Subscriber;
use App\LogEmail;
use Illuminate\Http\Request;
use App\Http\Requests\AddSubscriber;
use Mail;

class HomeController extends Controller
{
    /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    session()->put('last_page', request()->url());
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('home');
  }

  public function poll(Poll $poll)
  {
    $poll->increment('pol_view');

    $poll_playlists = $poll->playlists;

    $voters = $poll->voters->take(5);

    $pl_titles = array_column($poll_playlists->toArray(), 'pl_title', 'polp_id');

    return view('public.poll_page', compact('poll', 'voters', 'poll_playlists', 'pl_titles'));
  }

  public function playlist(Playlist $playlist)
  {
    $owner = $playlist->owner;

    $playlist->increment('pl_view');

    $mostViewed = $playlist->mostViewed([$playlist->pl_id]);

    $videos = $playlist->videos;

    return view('public.playlist_page', compact('playlist', 'videos', 'owner', 'mostViewed'));
  }

  public function playlistPopUp(Playlist $playlist)
  {
    $playlist->increment('pl_view');

    $videos = $playlist->videos;

    return view('public.playlist_popup', compact('playlist', 'videos'));
  }

  public function subscribe(AddSubscriber $request)
  {
    $susbcriberObj = new Subscriber;

    $input = $request->except('_token');

    // Add to database
    $subscriber = $susbcriberObj->create($input);

    // Send to Sendgrid
    $susbcriberObj->sendSendgrid($subscriber);

    // Email notification
    $email = new LogEmail;

    $email->sendNewSusbcriber($subscriber);

    if ($request->ajax() || $request->wantsJson()) {
      return response()->json(['message' => trans('messages.subscribe_successful')]);
    } else {
      return back()->with('message', trans('messages.subscribe_successful'));
    }
  }

  public function explainerPopUp()
  {
    return view('explainer_popup');
  }

  public function welcome(Request $request)
  {
    $play = $request->input('play');
    
    return view('welcome', compact('play'));
  }
}
