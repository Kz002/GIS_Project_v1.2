<?php

namespace App\Controllers;
use App\Models\ModelAuth;
class Auth extends BaseController
{
    public function __construct() 
    {
    helper('form');   
    $this-> ModelAuth= new ModelAuth();
    }
    public function register() 
    {
        $data = array(
            'title' => 'register',
        );
        return view('v_register', $data);
    }
    public function save_register() 
    {
       if ($this->validate([
        'nama_user'=> [
            'label' => 'Nama User',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong !'
            ]
        ],
        'email'=> [
            'label' => 'E-Mail',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong !'
            ]
        ],
        'no_hp'=> [
            'label' => 'No Handphone',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong !'
            ]
        ],
        'password'=> [
            'label' => 'Password',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong !'
            ]
        ],
        'repassword'=> [
            'label' => 'Repeat Password',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong !',
                'matches' => '{field} Tidak Sama !'
            ]
        ]
       ])) {
        //jika valid
        $data = array(
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'password' => $this->request->getPost('password'),
            'level' => 3
            //level akses 1 admon;2 user;3 pengunjung
        );
        $this->ModelAuth->save_register($data);
        session()->setFlashdata('pesan','Regisrasi Akun Berhasil !');
        return redirect()->to(base_url('Auth/register'));
       }else {
        //jika tidak valid
        session()->setFlashdata('errors', \config\Services::validation()->getErrors());
        return redirect()->to(base_url('Auth/register'));
       }
    }
    public function login() 
    {
        $data = array(
            'title' => 'Login',
        );
        return view('v_login', $data);
    }
    public function cek_login() 
    {
        if ($this->validate([
            'email'=> [
                'label' => 'E-Mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !'
                ]
            ],
            'password'=> [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong !'
                ]
            ],
        ])) {
            //jika valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek = $this->ModelAuth->login($email,$password);
            if ($cek) {
                //jika data ditemukan
                session()->set('log',true);
                session()->set('nama_user',$cek['nama_user']);
                session()->set('email',$cek['email']);
                session()->set('level',$cek['level']);
                session()->set('foto_user',$cek['foto_user']);
                //login
                return redirect()->to(base_url('Home'));
            }else {
                //jika data tidak cocok
                session()->setFlashdata('pesan','Email atau Password Tidak Cocok !');
                return redirect()->to(base_url('Auth/login'));

            }
        } else {
            //jika tidak valid
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/login'));
        }
    }
    public function logout()
    {
        session()->remove('log');
        session()->remove('nama_user');
        session()->remove('level');
        session()->remove('foto_user');
        session()->setFlashdata('pesan','Logout Berhasil !');
                return redirect()->to(base_url('Auth/login'));

    }
       
}