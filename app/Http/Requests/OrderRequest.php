<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postOffice' => ['required', 'string', 'max:255'],
            'paymentMethod' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'total_price' => ['required', 'numeric'],
            'cart' => ['required', 'array'],
            'cart.*.id' => ['required', 'numeric'],
            'cart.*.name' => ['required', 'string', 'max:255'],
            'cart.*.image' => ['required', 'string', 'max:255'],
            'cart.*.price' => ['required', 'numeric'],
            'cart.*.quantity' => ['required', 'numeric'],
        ];
    }

}
