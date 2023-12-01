<?php

namespace App\Controllers;
use App\Models\ModelLokasi;
class Lokasi extends BaseController
{
    public function __construct() 
    {
        $this->ModelLokasi = new ModelLokasi();
    }

    public function index()
    {
        $data = [
            'judul' => 'Data Lokasi',
            'page'  => 'Lokasi/v_data_lokasi',
            'lokasi' => $this->ModelLokasi->getAlldata(),
        ];
        return view('v_template', $data);
    }
    public function inputLokasi()
    {
        $data = [
            'judul' => 'Input Lokasi',
            'page'  => 'Lokasi/v_input_lokasi',
        ];
        return view('v_template', $data);
    }
    public function insertData()
    {
        if ($this->validate([
            'nama_lokasi'=> [
                'label'=> 'Nama Lokasi',
                'rules'=> 'required',
                'errors'=> [
                    'required'=> '{field} tidak boleh kosong !!!'
                ]
            ],
            'alamat_lokasi'=> [
                'label'=> 'Alamat Lokasi',
                'rules'=> 'required',
                'errors'=> [
                    'required'=> '{field} tidak boleh kosong !!!'
                ]
            ],
            'latitude'=> [
                'label'=> 'Latitude',
                'rules'=> 'required',
                'errors'=> [
                    'required'=> '{field} tidak boleh kosong !!!'
                ]
            ],
            'longitude'=> [
                'label'=> 'Longitude',
                'rules'=> 'required',
                'errors'=> [
                    'required'=> '{field} tidak boleh kosong !!!'
                ]
            ],
            'foto_lokasi'=> [
                'label'=> 'Foto Lokasi',
                'rules'=> 'uploaded[foto_lokasi]|max_size[foto_lokasi,2048]|mime_in[foto_lokasi,image/jpg,image/jpeg,image/png,image/gif]',
                'errors'=> [
                    'uploaded'=> '{field} tidak boleh kosong !!!',
                    'max_size'=> 'Ukuran {field} maksimal 2048 KB !!!',
                    'mime_in'=> 'Format {field} Harus jpg, jpeg, atau png !!!',
                ]
            ]  
        ])) {
            $foto_lokasi = $this->request->getFile('foto_lokasi');
            $nama_file_foto = $foto_lokasi->getRandomName(); 
            //jika lolos validasi
            $data = [
                'nama_lokasi'=> $this->request->getPost('nama_lokasi'),
                'alamat_lokasi'=> $this->request->getPost('alamat_lokasi'),
                'latitude'=> $this->request->getPost('latitude'),
                'longitude'=> $this->request->getPost('longitude'),
                'foto_lokasi'=> $nama_file_foto,
            ];
            $foto_lokasi->move('foto',$nama_file_foto);
            //kirim data ke function insert data di model lokasi
            $this->ModelLokasi->insertData($data);
            //notifikasi data berhasil disimpan
            session()->setFlashdata('pesan', 'Data Lokasi Berhasil Ditambahkan !!!');
            return redirect()->to('Lokasi/inputLokasi');

        }else {
            //jika tidak lolos validasi
            return redirect()->to('Lokasi/inputLokasi')->withInput();
        }
    }

    public function pemetaanlokasi()
    {
        $data = [
            'judul' => 'Pemetaan Lokasi',
            'page'  => 'Lokasi/v_pemetaan_lokasi',
            'lokasi' => $this->ModelLokasi->getAlldata(),
        ];
        return view('v_template', $data);
    }
    public function editLokasi($id_lokasi)
    {
        $data = [
            'judul' => 'Edit Lokasi',
            'page'  => 'Lokasi/v_edit_lokasi',
            'lokasi' => $this->ModelLokasi->getDataById($id_lokasi),
        ];
        return view('v_template', $data);
    }
    public function updateData($id_lokasi)
    {
        if ($this->validate([
            'nama_lokasi'=> [
                'label'=> 'Nama Lokasi',
                'rules'=> 'required',
                'errors'=> [
                    'required'=> '{field} tidak boleh kosong !!!'
                ]
            ],
            'alamat_lokasi'=> [
                'label'=> 'Alamat Lokasi',
                'rules'=> 'required',
                'errors'=> [
                    'required'=> '{field} tidak boleh kosong !!!'
                ]
            ],
            'latitude'=> [
                'label'=> 'Latitude',
                'rules'=> 'required',
                'errors'=> [
                    'required'=> '{field} tidak boleh kosong !!!'
                ]
            ],
            'longitude'=> [
                'label'=> 'Longitude',
                'rules'=> 'required',
                'errors'=> [
                    'required'=> '{field} tidak boleh kosong !!!'
                ]
            ],
            'foto_lokasi'=> [
                'label'=> 'Foto Lokasi',
                'rules'=> 'max_size[foto_lokasi,2048]|mime_in[foto_lokasi,image/jpg,image/jpeg,image/png,image/gif]',
                'errors'=> [
                    'max_size'=> 'Ukuran {field} maksimal 2048 KB !!!',
                    'mime_in'=> 'Format {field} Harus jpg, jpeg, atau png !!!',
                ]
            ]  
        ])) {
            $foto_lokasi = $this->request->getFile('foto_lokasi');
            

            $lokasi = $this->ModelLokasi->getDataById($id_lokasi);
            if ($foto_lokasi->getError() == 4) {
                $nama_file_foto = $lokasi['foto_lokasi'];
            }else {
                $nama_file_foto = $foto_lokasi->getRandomName();
                $foto_lokasi->move('foto',$nama_file_foto);
            }
            //jika lolos validasi
            $data = [
                'id_lokasi' => $id_lokasi,
                'nama_lokasi'=> $this->request->getPost('nama_lokasi'),
                'alamat_lokasi'=> $this->request->getPost('alamat_lokasi'),
                'latitude'=> $this->request->getPost('latitude'),
                'longitude'=> $this->request->getPost('longitude'),
                'foto_lokasi'=> $nama_file_foto,
            ];
            //kirim data ke function insert data di model lokasi
            $this->ModelLokasi->updateData($data);
            //notifikasi data berhasil diupdate
            session()->setFlashdata('pesan', 'Data Lokasi Berhasil Diupdate !!!');
            return redirect()->to('Lokasi/index');

        }else {
            //jika tidak lolos validasi
            return redirect()->to('Lokasi/editLokasi/'.$id_lokasi)->withInput();
        }
    }
    public function deleteLokasi($id_lokasi)
    {
        $data = [
            'id_lokasi' => $id_lokasi,
        ];
        //kirim data ke function insert data di model lokasi
        $this->ModelLokasi->deleteData($data);
        //notifikasi data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Lokasi Berhasil Di delete !!!');
        return redirect()->to('Lokasi/index');
    }
}