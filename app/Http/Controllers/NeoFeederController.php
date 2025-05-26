<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NeoFeederJsonService;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
        $username = 'rroyani887@gmail.com';
        $password = 'Maju@2024';

        $tokenResponse = $this->feeder->getToken($username, $password);

        if (!empty($tokenResponse['error_code'])) {
            return response()->json(['error' => $tokenResponse['error_desc']], 400);
        }

        $token = $tokenResponse['data']['token'];

        $mahasiswa = $this->feeder->getListMahasiswa($token);

        return response()->json($mahasiswa);
    }

    public function insertMahasiswa(NeoFeederJsonService $feeder)
    {
        try {
            $username = 'rroyani887@gmail.com';
            $password = 'Maju@2024';

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


}
