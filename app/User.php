<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Traits\ModelTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    use ModelTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_id', 'avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeFilter($query, $filter = [])
    {
        if (array_get($filter, 'name')) {
            $query->where('name', 'like', '%' . $filter['name'] . '%');
        }
        if (array_get($filter, 'email')) {
            $query->where('email', 'like', '%' . $filter['email'] . '%');
        }
    }

    public function playlists()
    {
      return $this->hasMany('App\Playlist', 'pl_user', 'id');
    }

    public function polls()
    {
      return $this->hasMany('App\Poll', 'pol_user', 'id');
    }

    public function stat()
    {
      $playlist_count = $this->playlists()->count();

      $poll_count = $this->polls()->count();

      return compact('playlist_count', 'poll_count');
    }
}
