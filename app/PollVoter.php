<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollVoter extends Model
{
    protected $fillable = ['pov_user', 'pov_poll', 'pov_poll_playlist'];

    public function scopeWithPlaylist($query)
    {
        $query->join('poll_playlists', 'pov_poll_playlist', '=', 'polp_id');
    }

    public function scopeWithPublicPoll($query)
    {
        $query->join('polls', 'pol_id', '=', 'pov_poll');
    }

    public function scopeWithUser($query)
    {
        $query->addSelect('name', 'email', 'avatar')->join('users', 'pov_user', '=', 'id');
    }

    public function voted($pol_id, $user_id = 0)
    {
      if (auth()->check()) {
        $user_id = $user_id > 0 ? $user_id : auth()->user()->id;

        $voted = $this->where('pov_user', '=', $user_id)->where('pov_poll', '=', $pol_id)->first();

        return isset($voted) ? $voted->pov_poll_playlist : 0;
      }
      return 0;
    }
}
