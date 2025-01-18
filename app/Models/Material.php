<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded =[];

    public function grade()
    {
        return  $this->belongsTo(Grade::class);
    }
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
