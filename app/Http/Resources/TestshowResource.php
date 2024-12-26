<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestshowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'photo' => asset('Exon/'.$this->photo),
            'created_at' => $this->created_at,
            'test_Type' =>  $this->test_Type,
            'des' => $this->des,
        ];
    }
}
