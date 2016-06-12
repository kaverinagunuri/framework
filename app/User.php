<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    protected $table = "User";
    protected $fillable = ['FirstName', 'LastName', 'UserName', 'GenderId', 'LastName', 'Password', 'ValidationToken', 'IsValidated', 'CreatedAt', 'UpdateAt', 'IsDeleted', 'DeletedAt'];
    public $timestamps = false;

}
