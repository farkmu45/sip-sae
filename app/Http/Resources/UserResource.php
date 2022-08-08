<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->student->name,
            'nis' => $this->student_nis,
            'classroom' => $this->student->classroom->name,
            'date_of_birth' => $this->student->date_of_birth,
            'gender' => $this->student->gender,
            'address' => $this->student->address,
            'school_distance' => $this->student->school_distance,
            'salary' => $this->student->salary,
            'token' => $this->createToken($request->getClientIp())->plainTextToken,
        ];
    }
}
