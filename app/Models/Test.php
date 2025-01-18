<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Stage;
use App\Models\Payment;
use App\Models\Material;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $guarded =[];
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }
    public function payments() {
         return $this->hasMany(Payment::class)->where('status', 'completed');
    }

}
