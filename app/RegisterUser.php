<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Model
{
    protected $table="User";
     protected $fillable = ['FirstName','LastName','UserName','GenderId','LastName','Password','ValidationToken','IsValidated','CreatedAt','UpdateAt','IsDeleted','DeletedAt'];
     public $timestamps=false;
}
