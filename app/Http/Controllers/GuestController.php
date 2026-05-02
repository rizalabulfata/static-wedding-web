<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rsvp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(Request $request): View
    {
        $rsvp = null;
        if ($request->has('u')) {
            $rsvp = Rsvp::where('unique_id', $request->query('u'))->first();
        }

        $comments = Comment::with('rsvp')
            ->where('is_visible', true)
            ->latest()
            ->simplePaginate(10);

        return view('welcome', compact('rsvp', 'comments'));
    }

    public function fetchComments(Request $request): JsonResponse
    {
        $comments = Comment::with('rsvp')
            ->where('is_visible', true)
            ->latest()
            ->simplePaginate(10);

        return response()->json($comments);
    }

    public function rsvp(Request $request): JsonResponse
    {
        $request->validate([
            'unique_id' => 'required|exists:rsvps,unique_id',
            'attendance' => 'required|in:hadir,tidak hadir',
        ]);

        $rsvp = Rsvp::where('unique_id', $request->unique_id)->firstOrFail();

        $rsvp->update([
            'attendance' => $request->attendance,
        ]);

        return response()->json(['message' => 'Konfirmasi berhasil disimpan.']);
    }

    public function comment(Request $request): JsonResponse
    {
        $request->validate([
            'unique_id' => 'required|exists:rsvps,unique_id',
            'comment' => 'required|string|max:1000',
        ]);

        $rsvp = Rsvp::where('unique_id', $request->unique_id)->firstOrFail();

        if ($rsvp->comments()->count() >= 5) {
            return response()->json(['message' => 'Maksimal 5 komentar per tamu.'], 422);
        }

        $comment = Comment::create([
            'rsvp_id' => $rsvp->id,
            'name' => $rsvp->name,
            'comment' => $request->comment,
            'is_visible' => true,
        ]);

        return response()->json([
            'message' => 'Komentar berhasil dikirim.',
            'comment' => $comment,
        ]);
    }
}
