<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title' => $this->title,
            'price' => $this->price,
            'teacher_id' => $this->teacher_id,
            'stage_id' => $this->stage_id,
            'grade_id' => $this->grade_id,
            'material_id' => $this->material_id,
            'photo' => asset('Exon/'.$this->photo),
            'pdf' =>$this->pdf ?asset('Exon/'.$this->pdf):null,
            'start_time' => $this->start_time,
            'end_time' =>  $this->end_time,
            'test_Type' =>  $this->test_Type,
            'des' => $this->des,
            "questions"=>$this->questions
        ];
    }
}
