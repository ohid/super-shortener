<?php

namespace SShortener;

use Illuminate\Database\Eloquent\Model;
use SShortener\User;
use SShortener\Url;

class Url extends Model
{

    protected $fillable = [
    	'user_id', 'url', 'short_url', 'clicks'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function options() 
    {
    	return $this->hasMany(Url::class);
    }
}
