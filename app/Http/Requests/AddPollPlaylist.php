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
        return [
            'polp_playlist' => 'required|exists:playlists,pl_id',
            'polp_poll' => 'required|exists:polls,pol_id',
        ];
    }
}
