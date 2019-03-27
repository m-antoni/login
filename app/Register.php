<?php

namespace App;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;


class Register extends Model
{
  	protected	$guarded = [];

    // encrypt password
    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = Crypt::encryptString($value);
    }

    // decrypt password
    public function getPassword()
    {
      return Crypt::decryptString($this->attributes['password']);
    }

    // default value in department option
    protected $attributes = [
        'department' => 0
    ];

    public function getDepartmentAttribute($attribute)
    {
    	return $this->departmentOption()[$attribute];
    }

    // Incharge of select value 
    public function departmentOption()
    {
      return [
           '0' => 'Admin Office',
           '1' => 'Finance',
           '2' => 'Accounting',
           '3' => 'Purchasing',
           '4' => 'IT Dept',
           '5' => 'Design & Engineering',
           '6' => 'Human Resource',
           '7' => 'Maintenance',
           '8' => 'Security'
      	];
    }

    // protected $dates = [
    //   'birthday',
    //   'date_hired',
    //   'created_at',
    //   'updated_at'
    // ];
}
