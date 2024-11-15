<?php

namespace Modules\Category\Http\Requests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
{
    use ApiResponseTrait;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'en.name' => 'required|string|max:255',
            'ar.name' => 'required|string|max:255',
            'en.description' => 'required|string',
            'ar.description' => 'required|string',
            'status' => 'required|boolean',
        ];

        if ($this->isMethod('POST')) {
            $rules['slug'] = 'required|string|unique:categories,slug';
        } else {
            $rules['slug'] = [
                'sometimes',
                'string',
                Rule::unique('categories')->ignore($this->method('PATCH'))
            ];
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        return throw new HttpResponseException($this->failedResponse($validator->errors(), 422));
    }
}
