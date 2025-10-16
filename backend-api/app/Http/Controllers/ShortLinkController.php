<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortLinkRequest;
use App\Http\Requests\UpdateShortLinkRequest;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $links = ShortLink::where('user_id', $user_id)->get(['id', 'original_url', 'code', 'clicks']);

        if (!$links) {
            return response()->json([
                'message' => 'Links not found'
            ], 404);
        }

        return response()->json([
            $links
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'original_url' => 'required|string|url:http,https',
            'custom_code' => 'string|max:10|unique:short_links'
        ]);

        $user_id = Auth::user()->id;

        function getRandomCode($n)
        {
            return bin2hex(random_bytes($n / 2));
        }

        $link = ShortLink::create([
            'user_id' => $user_id,
            'original_url' => $data['original_url'],
            'code' => $data['custom_code'] ?? getRandomCode(10),
            'clicks' => 0,
        ]);

        return response()->json([
            $link->only('id', 'user_id', 'original_url', 'code', 'clicks', 'created_at')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShortLink $shortLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortLink $shortLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShortLinkRequest $request, ShortLink $shortLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       $id = $request->id;
       $link = ShortLink::where('id', $id);

       if (!$link) {
            return response()->json([
            ], 404);
       }

       $link->delete();

        return response()->json([
            "message" => "Link deleted successfully"
        ], 200);
    }
}
