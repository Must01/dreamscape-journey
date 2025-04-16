<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlist = $user->wishlist;
        
        return view('wishlist.index', compact('wishlist'));
    }

    public function add($id)
    {
        $destination = Destination::findOrFail($id);
        $user = Auth::user();
        
        if (!$user->wishlist()->where('destination_id', $id)->exists()) {
            $user->wishlist()->attach($id);
            $message = 'Destination added to wishlist.';
        } else {
            $message = 'Destination is already in your wishlist.';
        }
        
        return back()->with('success', $message);
    }

    public function remove($id)
    {
        $user = Auth::user();
        $user->wishlist()->detach($id);
        
        return back()->with('success', 'Destination removed from wishlist.');
    }
}