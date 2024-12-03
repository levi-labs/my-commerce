<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules =  [
            'name' => 'required|string|max:60',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:2000',
        ];

        if ($this->isMethod('POST')) {
            $rules['image_url'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        if ($this->isMethod('PUT')) {
            $rules['image_url'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
    /**
     * Siapkan data untuk validasi.
     * Ini akan dijalankan sebelum validasi dilakukan.
     */
    protected function prepareForValidation()
    {
        // Memeriksa dan menghapus titik pada harga (jika ada) sebelum validasi
        if ($this->price) {
            // Menghapus semua titik
            $this->merge([
                'price' => str_replace('.', '', $this->price),
            ]);
        }
        // if (strpos($this->price, '.') === false) {
        //     $this->merge([
        //         'price' => $this->price . '.00',
        //     ]);
        // }
    }
}
