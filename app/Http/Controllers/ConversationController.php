<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConversationController extends Controller
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
        $title = 'Data Conversation';
        $conversations = Conversation::orderBy('created_at', 'desc')
            ->paginate(10);


        // Kirim data ke view
        return view('pages.conversation', compact('sidebarItems', 'filename','title'));
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
    public function saveConversation(Request $request)
    {
        $request->validate([
            'user_id'       => 'nullable|exists:users,id',
            'guest_token'   => 'nullable|string',
            'session_token' => 'nullable|string',
            'start_time'    => 'nullable|date',
            'end_time'      => 'nullable|date',
            'status'        => 'nullable|in:in-progress,completed,error'
        ]);

        // Generate token acak
        // - guest_token untuk identifikasi guest
        // - session_token untuk identifikasi sesi percakapan
        $guestToken = Str::random(6);
        $sessionToken = Str::random(6);

        $conversation = Conversation::create([
            'user_id'       => $request->user_id,
            'guest_token'   => $guestToken,
            'session_token' => $sessionToken,
            'start_time'    => $request->start_time ?? now(),
            'end_time'      => $request->end_time,
            'status'        => $request->status ?? 'in-progress',
        ]);

        return response()->json(['data' => $conversation,'status' => 201],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation,$id)
    {
        $conversation = Conversation::findOrFail($id);

        return response()->json($conversation);
    }


}
