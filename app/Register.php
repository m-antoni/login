<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
  	protected	$guarded = [];

    public function getDepartmentAttribute($attribute)
    {
    	return $this->departmentOption()[$attribute];
    }

    public function departmentOption()
    {
      return [
	         '0' => 'President\'s Office',
	         '1' => 'Finance',
	         '2' => 'Accounting',
	         '3' => 'Purchasing',
	         '4' => 'IT Dept',
	         '5' => 'Design & Engineering',
	         '6' => 'Human Resource',
	         '7' => 'Maintenance',
	         '8' => 'Security',
      	];
    }
}
