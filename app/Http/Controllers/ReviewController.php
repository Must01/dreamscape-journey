<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
        
        $review = Review::create([
            'destination_id' => $validatedData['destination_id'],
            'user_id' => Auth::id(),
            'rating' => $validatedData['rating'],
            'comment' => $validatedData['comment'],
        ]);
        
        return redirect()->route('destinations.show', $validatedData['destination_id'])
            ->with('success', 'Review added successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        // Ensure the review belongs to the authenticated user or admin
        if ($review->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        
        $destinationId = $review->destination_id;
        $review->delete();
        
        return redirect()->route('destinations.show', $destinationId)
            ->with('success', 'Review deleted successfully.');
    }
}