<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbiturentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                    'name' => 'required|string|alpha|max:200',
                    'surname' => 'required|string|alpha|max:200',
                    'gender' => 'required|numeric',
                    'groupNumber' => 'required|numeric',
                    'email' => 'required|email|unique:abiturents,email',
                    'totalEge' => 'required|numeric|max:400|min:0',
                    'birthday' => 'required|date',
                    'phone' => 'required|string|max:20',
                ];
            }
            case 'PUT': {
                return [
                    'name' => 'required|string|alpha|max:200',
                    'surname' => 'required|string|alpha|max:200',
                    'gender' => 'required|numeric',
                    'groupNumber' => 'required|numeric',
                    'totalEge' => 'required|numeric|max:400|min:0',
                    'birthday' => 'required|date',
                    'phone' => 'required|string',
                ];
            }
            default:
                return [];
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле имя обязательно для заполнения',
            'name.string' => 'Поле имя должно быть строкой',
            'name.alpha' => 'Поле имя должно содержать только буквы',
            'name.max' => 'Поле имя не должно превышать 200 символов',
            'surname.required' => 'Поле фамилия обязательно для заполнения',
            'surname.string' => 'Поле фамилия должно быть строкой',
            'surname.alpha' => 'Поле фамилия должно состоять только из букв',
            'surname.max' => 'Поле фамилия не должно превышать 200 символов',
            'gender.required' => 'Поле пол обязательно для заполнения',
            'gender.numeric' => 'Поле пол должно быть числом',
            'groupNumber.required' => 'Поле номер группы обязательно для заполнения',
            'groupNumber.numeric' => 'Поле номер группы должно содержать только цифры',
            'totalEge.required' => 'Поле сумма баллов обязательно для заполнения',
            'totalEge.numeric' => 'Поле сумма баллов должно содержать только цифры',
            'totalEge.max' => 'Поле сумма баллов не может быть больше 400',
            'totalEge.min' => 'Поле сумма баллов не может быть ниже 0',
            'birthday.required' => 'Поле дата рождения обязательно для заполнения',
            'birthday.date' => 'Неправильный формат даты',
            'phone.required' => 'Поле номер телефона обязательно для заполнения',
            'phone.string' => 'Поле номер телефона должно быть строкой',
        ];
    }
}
