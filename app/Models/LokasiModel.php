<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'tbl_log';
    protected $primaryKey = 'id_log'; // Ganti dengan primary key tabel lokasi jika ada
    protected $allowedFields = ['nama_user', 'latitude', 'longitude', 'alamat']; // Kolom yang dapat diisi

    // Definisikan aturan validasi, relasi, dan fungsi lainnya jika diperlukan
    public function simpanData($nama_user, $latitude, $longitude, $alamat)
    {
        $data = [
            'nama_user' => $nama_user,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'alamat' => $alamat
        ];

        return $this->insert($data); // Menyimpan data ke dalam tabel
    }
}
