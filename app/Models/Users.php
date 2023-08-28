<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ["avatar", "lastname", "firstname","birthday", "password", "email","email_verified"];

    protected $table = 'users';
    //use HasFactory;
}
