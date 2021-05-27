<?php
/*
|--------------------------------------------------------------------------
| Author: Sebastian Arboleda Botero
| Email:  sarboledab@eafit.edu.co
|--------------------------------------------------------------------------
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Survey extends Model
{

    //attributes id, name, commune, career, created_at, updated_at

    protected $fillable = [
        'name',
        'commune',
        'career',
        'user_id'
    ];

    public static function validate(Request $request)
    {
        $request->validate(
            [
                "name" => "required",
                "commune" => "required",
                "career" => "required",
                "user_id" => "required",
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

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getCommune()
    {
        return $this->attributes['commune'];
    }

    public function setCommune($commune)
    {
        $this->attributes['commune'] = $commune;
    }

    public function getCareer()
    {
        return $this->attributes['career'];
    }

    public function setCareer($career)
    {
        $this->attributes['career'] = $career;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }
}
