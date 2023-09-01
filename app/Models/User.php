<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    //use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "avatar", 
        "lastname", 
        "firstname",
        "birthday", 
        "password", 
        "email",
        "email_verified",
        "email_verified_at"
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    public function blogs(){
        return $this->hasMany(Blog::class, 'user_id', 'id');
    }

    public function scopeActive($query){
        $query->where('email_verified', true);
    }


    /* protected static function booted(){
        static::created(function ($user){
            $user->update("email_veridied", true);
        });

        static::creating(function ($user){
            $user->update(["email_veridied" => false]);
        });
    } */

    public function getFullnameAttribute(){
        return $this->lastname.' '.$this->firstname;
    }

    public function getAgeAttribute(){
        if($this->birthday){
            $date_bithday = new DateTime($this->birhday);
            $date_now = new DateTime();
            $cal = $date_now->diff($date_bithday);
            return $cal->y;
        }
        return 0;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /* protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]; */
}
