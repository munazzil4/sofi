<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $guarded = [];
	 protected $table = 'user_roles';
}