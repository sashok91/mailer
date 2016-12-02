<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMailingRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email_theme' => 'required|max:255',
            'email_text' => 'required',
            'scheduled_date_html' => 'date_format:"Y-m-d\Th:i"',
            'mailing_groups' => 'required|array'
        ];
    }
}