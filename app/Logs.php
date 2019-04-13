<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{	 
	protected $fillable = [
			'register_id',
			'qrcode',
    	'name',
    	'time_in',
    	'time_out',
    	'status'
    ];

    protected $dates = [
			'time_in',
			'time_out',
			'created_at',
			'updated_at'
    ];

	  public function register()
	  {
	    return $this->belongsTo('App\Register');
	  }
}
