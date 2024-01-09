<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLokasi extends Model
{
   //fungsi insert data
   public function insertData($data)
   {
    $this->db->table('tbl_lokasi')->insert($data);
   }

   //fungsi mengambil data dari database
   public function getAllData()
   {
    return $this->db->table('tbl_lokasi')
      ->get()->getResultArray();
   }

   //fungsi mengambil data berdasarkan id
   public function getDataById($id_lokasi)
   {
    return $this->db->table('tbl_lokasi')
      ->where('id_lokasi', $id_lokasi)
      ->get()->getRowArray();
   }

    //fungsi update data
    public function updateData($data)
    {
     $this->db->table('tbl_lokasi')
     ->where('id_lokasi', $data['id_lokasi'])
     ->update($data);
    }

    //fungsi delete data
    public function deleteData($data)
    {
     $this->db->table('tbl_lokasi')
     ->where('id_lokasi', $data['id_lokasi'])
     ->delete($data);
    }
    public function simpanPosisi($latitude, $longitude) {
      // Lakukan penyimpanan data posisi ke dalam tabel 'tbl_log'
      $data = array(
          'latitude' => $latitude,
          'longitude' => $longitude
          // Tambahkan kolom lainnya jika ada
      );

      // Simpan data ke dalam tabel 'tbl_log'
      $result = $this->db->insert('tbl_log', $data);

      return $result;
  }
}
