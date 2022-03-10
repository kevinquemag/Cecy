<?php

namespace App\Http\Requests\V1\Cecy\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class DestroysInstructorRequest  extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'ids' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'ids' => 'ID`s de los instructores',
        ];
    }
}
