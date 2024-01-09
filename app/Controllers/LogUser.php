<?php

namespace App\Controllers;
use App\Models\TabelLog;
class LogUser extends BaseController
{
    public function __construct() 
    {
        $this-> TabelLog= new TabelLog();
    }
    
    public function index()
    {
        $data = [
            'judul' => 'Log User',
            'page'  => 'v_log_user',
            'log' => $this->TabelLog->getAlldata(),
        ];
        return view('v_template', $data);
    }
    public function deleteLog($id_log)
    {
        $data = [
            'id_log' => $id_log,
        ];
        //kirim data ke function insert data di model lokasi
        $this->TabelLog->deleteData($data);
        //notifikasi data berhasil disimpan
        session()->setFlashdata('pesan', 'Log User Berhasil Di delete !!!');
        return redirect()->to('LogUser');
    }
}