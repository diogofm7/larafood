<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTable extends FormRequest
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
            'identify' => ['required', 'min:3', 'max:255', 'unique:tables,identify,'. $this->route('table') .',id'],
            'description' => ['nullable', 'min:3', 'max:1000']
        ];
    }
}
