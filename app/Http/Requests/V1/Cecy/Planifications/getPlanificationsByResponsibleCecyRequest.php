<?php

namespace App\Http\Requests\V1\Cecy\Planifications;

use Illuminate\Foundation\Http\FormRequest;

class GetPlanificationsByResponsibleCecyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
          
        ];
    }

    public function attributes()
    {
        return [
           
         
        ];
    }
}
