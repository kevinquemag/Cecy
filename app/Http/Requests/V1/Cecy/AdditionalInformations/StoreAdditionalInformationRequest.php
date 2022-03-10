<?php

namespace App\Http\Requests\V1\Cecy\AdditionalInformations;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdditionalInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'levelInstruction.id' => ['required', 'integer'],
            'registration.id' => ['required', 'integer'],
            'companyActivity' => ['required'],
            'companyAddress' => ['required'],
            'companyEmail' => ['required'],
            'companyName' => ['required'],
            'companyPhone' => ['required'],
            'companySponsored' => ['required'],
            'contactName' => ['required'],
            'courseFollows' => ['required'],
            'courseKnows' => ['required'],
            'worked' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'levelInstruction.id' => 'Id del nivel de instrucción',
            'registration.id' => 'Id del registro',
            'companyActivity' => 'Actividad de la empresa',
            'companyAddress' => 'Direccion fisica de empresa',
            'companyEmail' => 'Correo de empresa',
            'companyName' => 'Nombre de empresa',
            'companyPhone' => 'Teléfono de empresa',
            'companySponsored' => 'La empresa patrocina',
            'contactName' => 'Nombre de contacto que patrocina',
            'courseFollows' => 'Horas prácticas',
            'courseKnows' => 'Entorno de aprendizaje',
            'worked' => 'Participante trabaja',
        ];
    }
}
