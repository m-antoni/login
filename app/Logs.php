<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{	 
	   /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
 
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
