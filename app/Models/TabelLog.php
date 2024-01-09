<?php
namespace App\Models;
use CodeIgniter\Model;

final class TabelLog extends Model
{
    public function getDataById($id_log)
   {
    return $this->db->table('tbl_log')
      ->where('id_log', $id_log)
      ->get()->getRowArray();
   }
   public function getAllData()
   {
    return $this->db->table('tbl_log')
      ->get()->getResultArray();
   }
   //fungsi delete data
   public function deleteData($data)
   {
    $this->db->table('tbl_log')
    ->where('id_log', $data['id_log'])
    ->delete($data);
   }
}
