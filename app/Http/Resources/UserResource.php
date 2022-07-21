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
            'token' => $this->createToken($request->getClientIp())->plainTextToken,
        ];
    }
}
