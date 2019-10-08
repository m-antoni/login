<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{	
	protected $guarded = [];
	
	public function register()
	{
	    return $this->belongsTo('App\Register');
	}
}
