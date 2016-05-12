<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Playlist;
use App\PlaylistRating;

class PlaylistRatingController extends Controller
{
    public function store(Request $request)
    {
      $input = $request->all();

      $input['plr_user'] = auth()->user()->id;

      return PlaylistRating::create($input);
    }
}
