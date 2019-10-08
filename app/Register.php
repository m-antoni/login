<?php

namespace App;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
    */
  	protected $guarded = [];

    /**
     * Set encrypt password
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = Crypt::encryptString($value);
    }

    /**
     * Get decrypt password
     *
     * @param  string  $value
     * @return void
     */
    public function getPassword()
    {
      return Crypt::decryptString($this->attributes['password']);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->last}, {$this->first} {$this->middle}";
    }

    /**
     * Get the middle name
     *
     * @param  string  $value
     * @return string
     */
    public function getMiddleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Set the value in department option
     *
     * @return string
    */
    protected $attributes = [
        'department' => 0
    ];

    /**
     * Get the department and set to departmentoptions()
     *
     * @return string
    */
    public function getDepartmentAttribute($attribute)
    {
      return $this->departmentOption()[$attribute];
    }

    /**
     * Set the incharge of select value 
     *
     * @return string
    */
    public function departmentOption()
    {
      return [
           '0' => 'Admin Office',
           '1' => 'Finance',
           '2' => 'Accounting',
           '3' => 'Purchasing',
           '4' => 'IT Dept',
           '5' => 'Design & Engineering',
           '6' => 'Human Resource'
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
     * Get the logs of the register
     *
    */
    public function logs()
    {
      return $this->hasMany('App\Logs');
    }

    public function notification()
    {
        return $this->hasMany('App\Notification'); 
    }
}
