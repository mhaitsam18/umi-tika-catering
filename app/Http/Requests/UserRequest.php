<?php

// UserRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'role' => 'required',
            'alamat_kirim' => 'required_if:role,member',
            'nomor_wa' => 'required_if:role,member|string|regex:/^(?:\+62|0)[0-9\s-]+$/',
        ];
    }
}
