<?php

namespace App\Models;

use App\Models\Test;
use App\Models\User;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $guraded =[];
    protected $table ="stages";
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function grades(){
        return $this->hasMany(Grade::class);
    }
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
