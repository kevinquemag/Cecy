<?php

namespace App\Http\Requests\V1\Cecy\Classrooms;

use Illuminate\Foundation\Http\FormRequest;

class IndexClassroomRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }
  public function rules()
  {
    return [];
  }

  public function attributes()
  {
    return [];
  }
}
