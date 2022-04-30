<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'matricule' => $this->matricule,
            'photo' => asset($this->photo),
            'email' => $this->email,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'footprint1' => $this->footprint1,
            'footprint2' => $this->footprint2,
            'footprint3' => $this->footprint3,
            'grade' => new TeacherGradeResource($this->whenLoaded('teacherGrade')),
            'statut' => new TeacherGradeResource($this->whenLoaded('teacherStatus')),
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'author' => 'Dev Master',
                'version' => '1.0.0'
            ],
        ];
    }
}
