<?php
namespace App\Models;
use CodeIgniter\Model;

final class DataUser extends Model
{
    public function getDataById($id_user)
   {
    return $this->db->table('tbl_user')
      ->where('id_user', $id_user)
      ->get()->getRowArray();
   }
   public function getAllData()
   {
    return $this->db->table('tbl_user')
      ->get()->getResultArray();
   }
   //fungsi delete data
   public function deleteData($data)
   {
    $this->db->table('tbl_user')
    ->where('id_user', $data['id_user'])
    ->delete($data);
   }
}
