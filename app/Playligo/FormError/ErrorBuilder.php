<?php

namespace App\Playligo\FormError;

use Carbon\Carbon;

use Illuminate\Support\HtmlString;

class ErrorBuilder
{
	public function block($errors, $field)
	{
		if ($errors->has($field)) {
			return $this->toHtmlString('<span class="label label-danger">'. $errors->first($field) . '</span>');
		}
		return null;
	}

	public function rating($class, $selected)
	{
		$str = '<select class="'.$class.'">';
		for ($i = 1; $i <= 5; $i++) {
			if ($selected >= $i && $selected < $i + 1) {
				$str .= '<option value="'.$selected.'" selected>'.$selected.'</option>';
			} else {
				$str .= '<option value="'.$i.'">'.$i.'</option>';
			}
		}
		$str .= '</select>';
		return $this->toHtmlString($str);
	}

	public function block_ajax($field)
	{
		return $this->toHtmlString('<span id="err_msg_'.$field.'"></span>');
	}

	public function human_time_diff($input)
	{
		return $this->toHtmlString(Carbon::createFromTimestamp(strtotime($input))->diffForHumans());
	}

    /**
     * Transform the string to an Html serializable object
     *
     * @param $html
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function toHtmlString($html)
    {
        return new HtmlString($html);
    }

}
