<?php

namespace App\Controllers;
use App\Models\DataUser;
class User extends BaseController
{
    public function __construct() 
    {
        $this-> DataUser= new DataUser();
    }
    
    public function index()
    {
        $data = [
            'judul' => 'Data User',
            'page'  => 'v_data_user',
            'user' => $this->DataUser->getAlldata(),
        ];
        return view('v_template', $data);
    }
    public function editLokasi($id_user)
    {
        $data = [
            'judul' => 'Edit User',
            'page'  => 'v_data_user',
            'lokasi' => $this->ModelLokasi->getDataById($id_user),
        ];
        return view('v_template', $data);
    }
    public function deleteUser($id_user)
    {
        $data = [
            'id_user' => $id_user,
        ];
        //kirim data ke function insert data di model lokasi
        $this->DataUser->deleteData($data);
        //notifikasi data berhasil disimpan
        session()->setFlashdata('pesan', 'Akun User Berhasil Di delete !!!');
        return redirect()->to('User');
    }
}