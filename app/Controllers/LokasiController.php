<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\LokasiModel;

class LokasiController extends BaseController
{
    use ResponseTrait;

    public function __construct() 
    {
        $this->LokasiModel = new LokasiModel();
    }

    public function simpanPosisi()
    {
        // Ambil data posisi dari request
        $requestData = $this->request->getJSON();

        // Tambahkan var_dump() untuk melihat data yang diterima dari permintaan
        var_dump($requestData); // Debug data yang diterima

        // Simpan data posisi ke dalam database (gunakan model untuk menyimpan ke database)
        $latitude = $requestData->latitude;
        $longitude = $requestData->longitude;

        // Contoh penggunaan model untuk menyimpan ke database
        $lokasiModel = new LokasiModel();
        $lokasiModel->insert([
            'latitude' => $latitude,
            'longitude' => $longitude,
            // Tambahkan kolom lain yang diperlukan dalam tabel lokasi
        ]);

        // Kirim respons bahwa posisi berhasil disimpan
        return $this->respond(['message' => 'Posisi berhasil disimpan'], 200);
    }
}
