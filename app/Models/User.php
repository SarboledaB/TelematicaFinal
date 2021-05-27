<?php

/*
|--------------------------------------------------------------------------
| Author: Anthony Garcia Moncada
| Email:  agarciam@eafit.edu.co
|--------------------------------------------------------------------------
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    //attributes id, username, type, firstName, lastName, email, password, remember_token, created_at, updated_at
    protected $fillable = ['username', 'type', 'firstName', 'lastName', 'email', 'password'];

    protected $hidden = ['password', 'remember_token',];

    public static function validate(Request $request)
    {
        $request->validate(
            [
            "username" => "required",
            "type" => "boolean",
            "firstName" => "required",
            "lastName" => "required",
            "email" => "required|email",
            "password" => "required"
            ]
        );
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getType()
    {
        return $this->attributes['type'];
    }

    public function setType($type)
    {
        $this->attributes['type'] = $type;
    }

    public function getUsername()
    {
        return $this->attributes['username'];
    }

    public function setUsername($username)
    {
        $this->attributes['username'] = $username;
    }

    public function getPassword()
    {
        return $this->attributes['password'];
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = $password;
    }

    public function getFirstName()
    {
        return $this->attributes['firstName'];
    }

    public function setFirstName($firstName)
    {
        $this->attributes['firstName'] = $firstName;
    }

    public function getLastName()
    {
        return $this->attributes['lastName'];
    }

    public function setLastName($lastName)
    {
        $this->attributes['lastName'] = $lastName;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }
    
    public function getRole()
    {
        return $this->attributes['role'];
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function donations() 
    {
        return $this->hasMany(Donation::class);
    }
}
