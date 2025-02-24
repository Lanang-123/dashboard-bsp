<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Baca file JSON dari folder public/json
        $json = file_get_contents(public_path('json/sidebar-items.json'));
        // Decode JSON menjadi object (atau array jika diinginkan dengan true)
        $sidebarItems = json_decode($json);

        // Tentukan $filename untuk penentuan active menu
        // Misalnya, ambil path saat ini atau nama route
        $filename = $request->path();
        $title = 'Data Messages';

        // Kirim data ke view
        return view('pages.message', compact('sidebarItems', 'filename','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
