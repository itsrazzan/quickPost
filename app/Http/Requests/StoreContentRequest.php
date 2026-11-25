<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Judul/caption saling melengkapi, dan media opsional harus milik user ini
     * serta belum dihapus (soft delete).
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255', 'required_without:caption'],
            'caption' => ['nullable', 'string', 'max:5000', 'required_without:title'],
            'media' => ['nullable', 'array'],
            'media.*' => [
                'integer',
                Rule::exists('media', 'id')
                    ->where('user_id', $this->user()->id)
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
