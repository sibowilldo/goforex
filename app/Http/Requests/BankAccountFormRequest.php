<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountFormRequest extends FormRequest
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
            'bank' => 'required',
            'account_number' => 'required|numeric',
            'branch' => 'required|numeric',
            'account_holder' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'bank.required' => 'The name of the Bank is required.',
            'account_number.required' => 'Account Number is required.',
            'account_number.numeric' => 'Account Number must be a number with no special characters such as spaces/dashes/underscores',
            'branch.required' => 'Branch Code is required.',
            'branch.numeric' => 'Branch Code must be a number with no special characters such as spaces/dashes/underscores',
            'account_holder.required' => 'Account Holder is required',
        ];
    }
}
