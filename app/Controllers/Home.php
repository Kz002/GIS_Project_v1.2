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
    public function Marker()
    {
        $data = [
            'judul' => 'Mahkota Kerupuk Location',
            'page'  => 'v_marker',
        ];
        return view('v_template', $data);
    }
    public function geoJSON()
    {
        $data = [
            'judul' => 'Distribution Area',
            'page'  => 'v_geojson',
        ];
        return view('v_template', $data);
    }
    public function getCoordinate()
    {
        $data = [
            'judul' => 'Get Coordinate',
            'page'  => 'v_get_coordinate',
        ];
        return view('v_template', $data);
    }
    
}