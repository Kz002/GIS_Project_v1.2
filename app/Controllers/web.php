<?php

namespace App\Controllers;

class Web extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Web',
            'page'  => 'v_web',
        ];
        return view('v_web', $data);
    }
}