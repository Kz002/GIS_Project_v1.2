<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'tbl_log';
    protected $primaryKey = 'id_log'; // Ganti dengan primary key tabel lokasi jika ada
    protected $allowedFields = ['latitude', 'longitude']; // Kolom yang dapat diisi

    // Definisikan aturan validasi, relasi, dan fungsi lainnya jika diperlukan
}
