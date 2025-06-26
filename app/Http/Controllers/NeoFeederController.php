<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NeoFeederJsonService;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\MahasiswaRequest; // Pastikan ini sesuai dengan namespace request yang kamu buat
class NeoFeederController extends Controller
{
    protected $feeder;

    public function __construct(NeoFeederJsonService $feeder)
    {
        $this->feeder = $feeder;
    }

    public function getToken()
    {
        $username = 'rroyani887@gmail.com'; // Ganti ke config/env jika perlu
        $password = 'Maju@2024';

        $response = $this->feeder->getToken($username, $password);

        // return response()->json($response);
        return FormatResponseJson::success($response['data'], 'Token berhasil didapatkan');
    }

    public function getListMahasiswa()
    {
        // $username = 'rroyani887@gmail.com';
        // $password = 'Maju@2024';

        // $tokenResponse = $this->feeder->getToken($username, $password);

        // if (!empty($tokenResponse['error_code'])) {
        //     return response()->json(['error' => $tokenResponse['error_desc']], 400);
        // }

        // $token = $tokenResponse['data']['token'];

        // $mahasiswa = $this->feeder->getListMahasiswa($token);
        
        // return response()->json($mahasiswa);
        
        try {
                $username = 'rroyani887@gmail.com';
                $password = 'Maju@2024';
        
                $tokenResponse = $this->feeder->getToken($username, $password);
        
                if (!empty($tokenResponse['error_code'])) {
                    return response()->json(['error' => $tokenResponse['error_desc']], 400);
                }
        
                $token = $tokenResponse['data']['token'];
        
                $mahasiswa = $this->feeder->getListMahasiswa($token);

                return FormatResponseJson::success($mahasiswa['data'], 'Daftar mahasiswa berhasil didapatkan');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function insertMahasiswa(NeoFeederJsonService $feeder)
    {
        try {
            $username = 'rroyani887@gmail.com';
            $password = 'Maju@2024';

            $validator = Validator::make(request()->all(), [
                'nama_mahasiswa' => 'required|string|max:100',
                'jenis_kelamin' => 'required|in:L,P',
                'tempat_lahir' => 'required|string|max:50',
                'tanggal_lahir' => 'required|date',
                'id_agama' => 'required|integer',
                'nik' => 'required|string|size:16',
                'npwp' => 'nullable|string|max:25',
                'nisn' => 'nullable|string|size:10',
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
                // Data KPS
                "penerima_kps" => "boolean",
                "nomor_kps" => "nullable|string|max:30",
                
                // Data Orang Tua
                "nik_ayah" => "required|string|size:16",
                "nama_ayah" => "required|string|max:100",
                "tanggal_lahir_ayah" => "required|date",
                "id_pendidikan_ayah" => "required|integer",
                "id_pekerjaan_ayah" => "required|integer",
                "id_penghasilan_ayah" => "required|integer",

                "nik_ibu" => "required|string|size:16",
                "nama_ibu_kandung" => "required|string|max:100",
                "tanggal_lahir_ibu" => "required|date",
                "id_pendidikan_ibu" => "required|integer",
                "id_pekerjaan_ibu" => "required|
integer",
                "id_penghasilan_ibu" => "required|integer",

                // Data Wali
                "nama_wali" => "nullable|string|max:100",
                "tanggal_lahir_wali" => "nullable|date",
                "id_pendidikan_wali" => "nullable|integer",
                "id_pekerjaan_wali" => "nullable|integer",
                "id_penghasilan_wali" => "nullable|integer",

                // Kebutuhan Khusus
                "id_kebutuhan_khusus_mahasiswa" => "required|integer",
                "id_kebutuhan_khusus_ayah" => "required|integer",
                "id_kebutuhan_khusus_ibu" => "required|integer",
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $record = [
                "nama_mahasiswa" => "Pangeran Khairan Asshabir Y Ayuba",
                "jenis_kelamin" => "L",
                "tempat_lahir" => "Banggai",
                "tanggal_lahir" => "2009-09-02",
                "id_agama" => 1,
                "nik" => "7207022308800001",
                "nisn" => null,
                "npwp" => null,
                "kewarganegaraan" => "ID",
                "jalan" => "Jl. Burung Mas Kompleks Gorontalo",
                "dusun" => null,
                "rt" => 5,
                "rw" => 0,
                "kelurahan" => "Kelurahan Tano Bonunungan",
                "kode_pos" => null,
                "id_wilayah" => 180102,
                "id_jenis_tinggal" => 1,
                "id_alat_transportasi" => null,
                "telepon" => null,
                "handphone" => null,
                "email" => null,
                "penerima_kps" => 0,
                "nomor_kps" => null,
                "nik_ayah" => "7207022308800001",
                "nama_ayah" => "Yusuf Ayuba",
                "tanggal_lahir_ayah" => "1980-08-23",
                "id_pendidikan_ayah" => 35,
                "id_pekerjaan_ayah" => 6,
                "id_penghasilan_ayah" => 13,
                "nik_ibu" => "7207022308800001",
                "nama_ibu_kandung" => "Isfatian",
                "tanggal_lahir_ibu" => "1982-11-23",
                "id_pendidikan_ibu" => 20,
                "id_pekerjaan_ibu" => 9,
                "id_penghasilan_ibu" => 14,
                "nama_wali" => null,
                "tanggal_lahir_wali" => null,
                "id_pendidikan_wali" => null,
                "id_pekerjaan_wali" => null,
                "id_penghasilan_wali" => null,
                "id_kebutuhan_khusus_mahasiswa" => 0,
                "id_kebutuhan_khusus_ayah" => 0,
                "id_kebutuhan_khusus_ibu" => 0
            ];

            // Dapatkan token awal (dari cache atau baru)
            $token = $feeder->getOrCacheToken($username, $password);
            $response = $feeder->insertBiodataMahasiswa($record);

            // Cek apakah error karena token
            if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
                // Refresh token
                $token = $feeder->refreshToken($username, $password);
                // Retry insert
                $response = $feeder->insertBiodataMahasiswa($record);
            }

            // Tangani jika masih gagal
            if (isset($response['error_code']) && $response['error_code'] !== '0') {
                return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal menyimpan data', 500);
            }

            return FormatResponseJson::success($response['data'] ?? [], 'Data mahasiswa berhasil disimpan');
        } catch (\Throwable $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        } catch (ValidationException $e) {
            // Tangani validasi error
            return FormatResponseJson::error(null, $e->getMessage(), 422);
        }
    }

    public function updateMahasiswa(NeoFeederJsonService $feeder)
    {
        try {
            $record = [
                "id_mahasiswa" => "UUID-ATAU-ID-VALID", // ← Ganti dengan ID yang valid dari NEO Feeder
                "nama_mahasiswa" => "Pangeran Khairan Asshabir Y Ayuba (Updated)",
                "jenis_kelamin" => "L",
                "tempat_lahir" => "Banggai",
                "tanggal_lahir" => "2009-09-02",
                "id_agama" => 1,
                "nik" => "7207022308800001",
                "kewarganegaraan" => "ID",
                "jalan" => "Jl. Burung Mas Kompleks Gorontalo",
                "rt" => 5,
                "rw" => 0,
                "kelurahan" => "Kelurahan Tano Bonunungan",
                "id_wilayah" => 180102,
                "id_jenis_tinggal" => 1,
                "nik_ayah" => "7207022308800001",
                "nama_ayah" => "Yusuf Ayuba",
                "tanggal_lahir_ayah" => "1980-08-23",
                "id_pendidikan_ayah" => 35,
                "id_pekerjaan_ayah" => 6,
                "id_penghasilan_ayah" => 13,
                "nik_ibu" => "7207022308800001",
                "nama_ibu_kandung" => "Isfatian",
                "tanggal_lahir_ibu" => "1982-11-23",
                "id_pendidikan_ibu" => 20,
                "id_pekerjaan_ibu" => 9,
                "id_penghasilan_ibu" => 14,
                "id_kebutuhan_khusus_mahasiswa" => 0,
                "id_kebutuhan_khusus_ayah" => 0,
                "id_kebutuhan_khusus_ibu" => 0
            ];

            $response = $feeder->updateBiodataMahasiswa($record);

            if (isset($response['error_code']) && $response['error_code'] !== '0') {
                return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal update mahasiswa', 500);
            }

            return FormatResponseJson::success($response['data'] ?? [], 'Data mahasiswa berhasil diperbarui');
        } catch (\Throwable $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function deleteMahasiswa(Request $request, NeoFeederJsonService $feeder)
    {
        try {
            $id_mahasiswa = $request->input('id_mahasiswa');

            if (!$id_mahasiswa) {
                return FormatResponseJson::error(null, 'id_mahasiswa wajib diisi', 422);
            }

            $response = $feeder->deleteBiodataMahasiswa($id_mahasiswa);

            if (isset($response['error_code']) && $response['error_code'] !== '0') {
                return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal hapus data', 500);
            }

            return FormatResponseJson::success($response['data'] ?? [], 'Data mahasiswa berhasil dihapus');
        } catch (\Throwable $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function getProdi()
    {
        $response = $this->feeder->GetProdi();

        if (!isset($response['error_code'])) {
            return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal mendapatkan daftar prodi', 500);
        }
        return FormatResponseJson::success($response['data'], 'Daftar prodi berhasil didapatkan');
    }

    public function getListMataKuliah()
    {
        $response = $this->feeder->GetListMataKuliah();

        if (!isset($response['error_code'])) {
            return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal mendapatkan daftar mata kuliah', 500);
        }
        return FormatResponseJson::success($response['data'], 'Daftar mata kuliah berhasil didapatkan');
    }

    public function getDetailMataKuliah()
    {
        $filter = "id_matkul = '369a803e-2814-416a-9e28-d52288712419'";

        $response = $this->feeder->GetDetailMataKuliah($filter);
        // dd($response);

        if (!isset($response['error_code'])) {
            return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal mendapatkan daftar mata kuliah', 500);
        }
        return FormatResponseJson::success($response['data'], 'Daftar detail mata kuliah berhasil didapatkan');
    }

    public function insertMataKuliah(NeoFeederJsonService $feeder)
    {
        try {
            $username = config('services.neofeeder.username');
            $password = config('services.neofeeder.password');

            $record = [
                "kode_mata_kuliah" => "KR001",
                "nama_mata_kuliah" => "test insert matakuliah",
                "id_prodi" => "f157b8d9-ce43-4d9e-8a1d-859a9ac8ccac", // informatika
                "id_jenis_mata_kuliah" => "A",
                "id_kelompok_mata_kuliah" => "A",
                "sks_mata_kuliah" => 2.00,
                "sks_tatap_muka" => 1.00,
                "sks_praktek" => 1.00,
                "sks_praktek_lapangan" => 0.00,
                "sks_simulasi" => 0.00,
                "metode_kuliah" => "",
                "ada_sap" => 0,
                "ada_silabus" => 0,
                "ada_bahan_ajar" => 0,
                "ada_acara_praktek" => 0,
                "ada_diktat" => 0,
                "tanggal_mulai_efektif" => "2018-07-22",
                "tanggal_akhir_efektif" => "2022-07-22"
            ];

            // Dapatkan token awal (dari cache atau baru)
            $token = $feeder->getOrCacheToken($username, $password);
            $response = $feeder->InsertMataKuliah($record);

            // Cek apakah error karena token
            if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
                // Refresh token
                $token = $feeder->refreshToken($username, $password);
                // Retry insert
                $response = $feeder->InsertMataKuliah($record);
            }

            // Tangani jika masih gagal
            if (isset($response['error_code']) && $response['error_code'] !== 0) {
                return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal menyimpan data', 500);
            }

            return FormatResponseJson::success($response['data'] ?? [], 'Data Matakuliah berhasil disimpan');
        } catch (\Throwable $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function updateMataKuliah(NeoFeederJsonService $feeder)
    {
        try {
            $username = config('services.neofeeder.username');
            $password = config('services.neofeeder.password');

            $key = '0614da8b-6612-4faa-ac44-cf1ab48a355e'; // id data

            $record = [
                "kode_mata_kuliah" => "KR001",
                "nama_mata_kuliah" => "test update matakuliah",
                "id_prodi" => "f157b8d9-ce43-4d9e-8a1d-859a9ac8ccac", // informatika
                "id_jenis_mata_kuliah" => "A",
                "id_kelompok_mata_kuliah" => "A",
                "sks_mata_kuliah" => 2.00,
                "sks_tatap_muka" => 1.00,
                "sks_praktek" => 1.00,
                "sks_praktek_lapangan" => 0.00,
                "sks_simulasi" => 0.00,
                "metode_kuliah" => "",
                "ada_sap" => 0,
                "ada_silabus" => 0,
                "ada_bahan_ajar" => 0,
                "ada_acara_praktek" => 0,
                "ada_diktat" => 0,
                "tanggal_mulai_efektif" => "2018-07-22",
                "tanggal_akhir_efektif" => "2022-07-22"
            ];

            // Dapatkan token awal (dari cache atau baru)
            $token = $feeder->getOrCacheToken($username, $password);
            $response = $feeder->UpdateMataKuliah($key, $record);

            // Cek apakah error karena token
            if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
                // Refresh token
                $token = $feeder->refreshToken($username, $password);
                // Retry insert
                $response = $feeder->UpdateMataKuliah($key, $record);

                // dd($response);
            }
            // dd($response);

            // Tangani jika masih gagal
            if (isset($response['error_code']) && $response['error_code'] !== 0) {
                return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal mengubah data', 500);
            }

            return FormatResponseJson::success($response['data'] ?? [], 'Data Matakuliah berhasil diubah');
        } catch (\Throwable $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function deleteMataKuliah(NeoFeederJsonService $feeder)
    {
        try {
            $username = config('services.neofeeder.username');
            $password = config('services.neofeeder.password');

            $key = '0614da8b-6612-4faa-ac44-cf1ab48a355e'; // id data
            
            // Dapatkan token awal (dari cache atau baru)
            $token = $feeder->getOrCacheToken($username, $password);
            $response = $feeder->DeleteMataKuliah($key);

            // Cek apakah error karena token
            if (isset($response['error_code']) && $response['error_code'] === 'ERROR_AUTH') {
                // Refresh token
                $token = $feeder->refreshToken($username, $password);
                // Retry insert
                $response = $feeder->DeleteMataKuliah($key);
            }

            // Tangani jika masih gagal
            if (isset($response['error_code']) && $response['error_code'] !== 0) {
                return FormatResponseJson::error(null, $response['error_desc'] ?? 'Gagal menghapus data', 500);
            }

            return FormatResponseJson::success($response['data'] ?? [], 'Data Matakuliah berhasil dihapus');
        } catch (\Throwable $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }


}
