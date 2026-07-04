<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __invoke(Request $request, string $shortCode): RedirectResponse
    {
        $link = Link::where('short_code', $shortCode)->firstOrFail();

        $link->visits()->create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referer' => $request->headers->get('referer'),
            'visited_at' => now(),
        ]);

        $link->increment('clicks_count');

        return redirect()->away($link->original_url);
    }
}
