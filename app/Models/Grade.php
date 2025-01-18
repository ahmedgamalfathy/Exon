<?php

namespace App\Models;

use App\Models\Test;
use App\Models\User;
use App\Models\Stage;
use App\Models\Material;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table="grades";
    protected $guarded =[];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
