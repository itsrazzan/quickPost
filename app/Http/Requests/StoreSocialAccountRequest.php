<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSocialAccountRequest extends FormRequest
{
    /**
     * Hanya user yang sudah login yang boleh menghubungkan akun sosial.
     * Route sudah dilindungi middleware "auth"; ini lapisan pengaman tambahan.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Pastikan platform yang dipilih valid dan aktif, serta field wajib terisi.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'social_platform_id' => [
                'required',
                'integer',
                Rule::exists('social_platforms', 'id')->where('is_active', true),
            ],
            'account_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Pesan validasi yang mudah dipahami pengguna.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'social_platform_id.required' => 'Pilih platform sosial.',
            'social_platform_id.exists' => 'Platform yang dipilih tidak tersedia.',
            'account_name.required' => 'Nama akun wajib diisi.',
            'username.required' => 'Username wajib diisi.',
        ];
    }
}
