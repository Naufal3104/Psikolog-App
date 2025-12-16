<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'NIK' => ['required', 'numeric', 'digits:16', Rule::unique(User::class, 'NIK')->ignore($this->user()->id)], // Perhatikan kolom 'NIK'
            'alamat' => ['nullable', 'string', 'max:255'],
            'no_telp' => ['nullable', 'numeric', 'digits_between:10,15'],
        ];

        // Tambahan aturan JIKA user adalah Psikolog
        if ($this->user()->hasRole('psikolog')) {
            $rules['NIP'] = ['required', 'string', 'max:50']; // Sesuaikan max length
            $rules['spesialisasi'] = ['required', 'string', 'max:255'];
        }
        return $rules;
    }
}
