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
      $plrRepo = new PlaylistRating;

      $input = $request->all();

      $input['plr_user'] = auth()->user()->id;

      $plrRepo->clear(array_get($input, 'plr_playlist'), array_get($input, 'plr_user'));

      PlaylistRating::create($input);

      // Return the latest playlist rating
      $rating = Playlist::find(array_get($input, 'plr_playlist'))->pl_rating;

      return response()->json(['message' => 'Thanks for your rating!', 'rating' => $rating]);
    }
}
