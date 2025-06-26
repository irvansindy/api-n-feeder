<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
        return [
            'nama_mahasiswa' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'id_agama' => 'required|integer',
            'nik' => 'required|string|size:16',
            'nisn' => 'nullable|string|size:10',
            'npwp' => 'nullable|string|max:25',
            'kewarganegaraan' => 'required|string|size:2',
            'jalan' => 'required|string|max:150',
            'dusun' => 'nullable|string|max:100',
            'rt' => 'required|integer|min:0|max:999',
            'rw' => 'required|integer|min:0|max:999',
            'kelurahan' => 'required|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'id_wilayah' => 'required|integer',
            'id_jenis_tinggal' => 'required|integer',
            'id_alat_transportasi' => 'nullable|integer',
            'telepon' => 'nullable|string|max:20',
            'handphone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'penerima_kps' => 'required|boolean',
            'nomor_kps' => 'nullable|string|max:30',

            'nik_ayah' => 'required|string|size:16',
            'nama_ayah' => 'required|string|max:100',
            'tanggal_lahir_ayah' => 'required|date',
            'id_pendidikan_ayah' => 'required|integer',
            'id_pekerjaan_ayah' => 'required|integer',
            'id_penghasilan_ayah' => 'required|integer',

            'nik_ibu' => 'required|string|size:16',
            'nama_ibu_kandung' => 'required|string|max:100',
            'tanggal_lahir_ibu' => 'required|date',
            'id_pendidikan_ibu' => 'required|integer',
            'id_pekerjaan_ibu' => 'required|integer',
            'id_penghasilan_ibu' => 'required|integer',

            'nama_wali' => 'nullable|string|max:100',
            'tanggal_lahir_wali' => 'nullable|date',
            'id_pendidikan_wali' => 'nullable|integer',
            'id_pekerjaan_wali' => 'nullable|integer',
            'id_penghasilan_wali' => 'nullable|integer',

            'id_kebutuhan_khusus_mahasiswa' => 'required|integer',
            'id_kebutuhan_khusus_ayah' => 'required|integer',
            'id_kebutuhan_khusus_ibu' => 'required|integer',
        ];
    }
    public function messages(): array
    {
        return [
            'nama_mahasiswa.required' => 'Nama mahasiswa wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).',
            'nik.size' => 'NIK harus terdiri dari 16 digit.',
            'email.email' => 'Format email tidak valid.',
            'tanggal_lahir.date' => 'Tanggal lahir mahasiswa tidak valid.',
            'tanggal_lahir_ayah.date' => 'Tanggal lahir ayah tidak valid.',
            'tanggal_lahir_ibu.date' => 'Tanggal lahir ibu tidak valid.',
            'tanggal_lahir_wali.date' => 'Tanggal lahir wali tidak valid.',
            'penerima_kps.boolean' => 'Penerima KPS harus berupa true atau false.',
            // Tambahkan custom message lain sesuai kebutuhan...
        ];
    }

}
