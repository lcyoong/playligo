<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTrait;

class Invite extends Model
{
  use ModelTrait;

  protected $table = 'invites';
  protected $primaryKey = 'inv_code';

}
