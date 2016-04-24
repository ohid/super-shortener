<?php

namespace SShortener;

use Illuminate\Database\Eloquent\Model;
use SShortener\Url;
use SShortener\Traits\OptionTrait;


class Option extends Model
{
	use OptionTrait;

	protected $fillable = [
		'url_id', 'user_agent', 'referer',  'ip', 'country_code', 'added'
	];

    public function url() 
    {
    	return $this->belongsTo(Url::class);
    }


}
