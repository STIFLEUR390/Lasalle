<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
            'faculty' => new FacultyResource($this->whenLoaded('faculty')),
            'date' => $this->date,
            'start_time' => substr($this->start_time, 0, 5),
            'end_time' => substr($this->end_time, 0, 5),
            'room' => new RoomResource($this->whenLoaded('room')),
            'course' => new CourseResource($this->whenLoaded('course')),
            'ue_code' => new UeCodeResource($this->whenLoaded('UeCode')),
            'status' => __($this->status),
            // 'hours' => substr($this->start_time, 0, 5) - substr($this->end_time, 0, 5),
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
