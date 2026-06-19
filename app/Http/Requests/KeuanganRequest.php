<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class KeuanganRequest extends FormRequest
{
    public $validator = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // Check if user has bendahara or superadmin role
        return auth()->check() &&
               in_array(auth()->user()->role, ['Administrator', 'Pengurus']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * For pemasukan: jumlah must be positive (not negative)
     * For pengeluaran: jumlah can be positive or negative (negative for refund/pengembalian)
     */
    public function rules()
    {
        return [
            'date' => 'required|date',
            'category_id' => 'required|uuid|exists:keuangan_categories,id',
            'note' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tipe' => 'required|in:pemasukan,pengeluaran',
        ];
    }

    /**
     * Custom validation for jumlah based on tipe
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $jumlah = $this->input('jumlah');
            $tipe = $this->input('tipe');

            if ($jumlah !== null && $tipe !== null) {
                // For pemasukan, jumlah should not be negative (unless it's a refund/pengembalian)
                // But we'll allow negative with a warning - actually, let's follow PRD:
                // "Validasi jumlah harus numerik dan tidak boleh negatif untuk pemasukan (kecuali pengembalian)"
                if ($tipe === 'pemasukan' && $jumlah < 0) {
                    $validator->errors()->add(
                        'jumlah',
                        'Jumlah pemasukan tidak boleh negatif kecuali untuk pengembalian'
                    );
                }
                // For pengeluaran, we allow negative (which would represent refund/pengembalian)
                // No additional validation needed for negative pengeluaran
            }
        });
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}