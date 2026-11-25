<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    /**
     * Hanya user yang sudah login yang boleh mengunggah media.
     * Route sudah dilindungi middleware "auth"; ini lapisan pengaman tambahan.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Batasi unggahan ke gambar yang aman dan berukuran wajar.
     * Maksimum 5120 KB (5 MB).
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
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
            'file.required' => 'Pilih gambar yang ingin diunggah.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format yang didukung: JPG, PNG, atau WebP.',
            'file.max' => 'Ukuran gambar maksimal 5 MB.',
        ];
    }
}
