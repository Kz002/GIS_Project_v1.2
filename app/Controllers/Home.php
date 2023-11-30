<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'page'  => 'v_dashboard',
        ];
        return view('v_template', $data);
    }
    public function baseMap()
    {
        $data = [
            'judul' => 'Base Map',
            'page'  => 'v_base_map',
        ];
        return view('v_template', $data);
    }
}