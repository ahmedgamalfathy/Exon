<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded=[];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function getIsCorrectAttribute($value)
    {
        return $value ? "الأجابة الصحيحة ":"الأجابة خطأ";
    }
}
