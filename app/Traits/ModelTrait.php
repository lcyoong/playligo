<?php
namespace app\Traits;

trait ModelTrait
{
    public function scopeGetPaginated($query, $perPage = 15)
    {
        return $query->paginate($perPage);
    }

    // Validate input
    public function validate($input, $rules)
    {
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return General::jsonBadResponse(implode("<br />", $validator->errors()->all()));
        } else {
            return null;
        }
    }
}
