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
            $note = $this->input('note');

            if ($jumlah !== null && $tipe !== null) {
                if ($tipe === 'pemasukan' && $jumlah < 0) {
                    // Allow negative only if note indicates pengembalian (case-insensitive)
                    if (empty($note) || !stripos($note, 'pengembalian')) {
                        $validator->errors()->add(
                            'jumlah',
                            'Jumlah pemasukan tidak boleh negatif kecuali untuk pengembalian'
                        );
                    }
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