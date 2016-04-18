<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Poll;
use App\Playlist;
use Illuminate\Http\Request;

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
        return view('public.poll_page', compact('poll'));
    }

    public function playlist(Playlist $playlist)
    {
        return view('public.playlist_page', compact('playlist'));
    }

}
