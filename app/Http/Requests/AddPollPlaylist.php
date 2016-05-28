<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddPollPlaylist extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->input();
        return [
          'polp_poll' => 'required|exists:polls,pol_id',
          'polp_playlist' => 'required|exists:playlists,pl_id|unique:poll_playlists,polp_playlist,NULL,polp_id,polp_poll,'.$input['polp_poll'],
        ];
    }
}
