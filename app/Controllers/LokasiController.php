<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\LokasiModel;

class LokasiController extends BaseController
{
    use ResponseTrait;
    protected $LokasiModel; // Deklarasi variabel LokasiModel

    public function __construct() 
    {
        $this->LokasiModel = new LokasiModel();
    }

    public function simpanPosisi()
    {
        // Mendapatkan data yang dikirim dari JavaScript
        $data = $this->request->getJSON();

        // Mendapatkan latitude dan longitude dari data
        $latitude = $data->latitude;
        $longitude = $data->longitude;

        // Reverse Geocoding dengan layanan Esri untuk mendapatkan alamat
        $url = 'https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/reverseGeocode?f=json&featureTypes=&location=' . $longitude . ',' . $latitude;
        $geocode = file_get_contents($url);
        $geocodeData = json_decode($geocode, true);

        // Mengambil alamat dari hasil geocoding
        $alamat = $geocodeData['address']['Match_addr'];

        // Mendapatkan nama pengguna dari sesi yang aktif
        $session = session(); // Mendapatkan instance session
        $nama_user = $session->get('nama_user'); // Ganti 'username' dengan kunci yang benar untuk nama pengguna

        $result = $this->LokasiModel->simpanData($nama_user, $latitude, $longitude, $alamat);

        if ($result) {
            echo "Data lokasi berhasil disimpan";
        } else {
            echo "Gagal menyimpan data lokasi";
        }
    }
}
