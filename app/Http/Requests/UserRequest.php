<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Tentukan apakah request diizinkan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',

            'username' => 'required|string|max:50|unique:users',

            'email' => 'required|email|unique:users',

            'password' => 'required|confirmed|min:8',

        ];
    }

    public function messages(): array
    {
    return [
        'name.required' => 'Nama wajib diisi.',

        'username.required' => 'Username wajib diisi.',
        'username.unique' => 'Username sudah digunakan.',

        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',

        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}