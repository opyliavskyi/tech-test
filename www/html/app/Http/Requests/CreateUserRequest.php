<?php

namespace App\Http\Requests;

use App\Models\Roles\ParentUser;
use App\Models\Roles\PrivateTutor;
use App\Models\Roles\Student;
use App\Models\Roles\Teacher;
use App\Validator\CustomValidator;
use App\Validator\Exceptions\ValidationException;
use App\Validator\Rules\SpecialCharactersRule;
use Illuminate\Validation\Validator;

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

    public function after(): array
    {
        return [
            function (Validator $validator) {
                try {
                    CustomValidator::validate(
                        [
                            'first_name' => [new SpecialCharactersRule()],
                            'last_name' => [new SpecialCharactersRule()],
                        ],
                        $this->request->all()
                    );
                } catch (ValidationException $validationException) {
                    foreach ($validationException->getErrors() as $key => $items) {
                        $validator->errors()->add($key, $items[0]);
                    }
                }
            },
        ];

    }
}
