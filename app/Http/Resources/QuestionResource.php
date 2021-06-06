<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    =>  $this->id,
            'question'  =>  $this->question,
            'options'   =>  [
                'option_a'  =>  $this->option_a,
                'option_b'  =>  $this->option_b,
                'option_c'  =>  $this->option_c,
                'option_d'  =>  $this->option_d,
            ],
            'correct_answer'    =>  $this->correct_answer,
        ];
    }
}
