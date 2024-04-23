<?php

namespace App\Http\Requests;

use App\Models\Roles\ParentUser;
use App\Models\Roles\PrivateTutor;
use App\Models\Roles\Student;
use App\Models\Roles\Teacher;

class CreateUserRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'string|required|max:255|min:1',
            'last_name' => 'string|required|max:255|min:1',
            'email' => 'email|required',
            'role' => 'required|in:'.implode(',', [ParentUser::ROLE, Student::ROLE, Teacher::ROLE, PrivateTutor::ROLE]),
        ];
    }
}
