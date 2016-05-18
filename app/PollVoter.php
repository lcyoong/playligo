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

    public function scopeWithUser($query)
    {
        $query->addSelect('name', 'email', 'avatar')->join('users', 'pov_user', '=', 'id');
    }

}
