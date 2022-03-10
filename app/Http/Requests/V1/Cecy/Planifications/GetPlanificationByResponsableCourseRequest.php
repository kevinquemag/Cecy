<?php

namespace App\Http\Requests\V1\Cecy\Planifications;

use Illuminate\Foundation\Http\FormRequest;

class GetPlanificationByResponsableCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'responsibleCourse.id' => ['required', 'integer'],
        ];
    }

    public function attributes()
    {
        return [
            'responsibleCourse.id' => 'Responsable del curso',
        ];
    }
}

