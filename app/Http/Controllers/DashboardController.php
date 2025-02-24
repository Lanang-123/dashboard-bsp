<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Baca file JSON dari folder public/json
        $json = file_get_contents(public_path('json/sidebar-items.json'));
        // Decode JSON menjadi object (atau array jika diinginkan dengan true)
        $sidebarItems = json_decode($json);

        // Tentukan $filename untuk penentuan active menu
        // Misalnya, ambil path saat ini atau nama route
        $filename = $request->path();
        $title = 'Dashboard BSP';

        // Kirim data ke view
        return view('pages.dashboard', compact('sidebarItems', 'filename','title'));
    }
}
