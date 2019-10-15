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
		protected $guarded = [];

		/**
		 * The attributes that should be mutated to dates.
		 *
		 * @var array
		*/
	  protected $dates = [
			'log_in',
			'log_out',
			'created_at',
			'updated_at'
	  ];

	  /**
	   * Get the status attribute
	   *
	   * @return string
	  */
	  public function getStatusAttribute($attribute)
	  {
	      return $this->statusOption()[$attribute];
	  }

	  /**
	   * Set the status values
	   *
	   * @return string
	  */
	  public function statusOption()
	  {
	    return [
	         '1' => 'Active',
	         '0' => 'Inactive',
	    	];
	   }

	  /**
     * Scope a query for desc order
     *
    */
	  public function scopeOrdered($query, $sort = 'desc')
	  {
	  		return $query->orderBy('created_at', $sort);
	  }	

	 	/**
		 * Get the register of the logs
		 *
		*/
	  public function register()
	  {
	    	return $this->belongsTo('App\Register');
	  }
}
