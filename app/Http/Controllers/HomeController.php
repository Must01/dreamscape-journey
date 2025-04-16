<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDestinations = Destination::latest()
            ->take(3)
            ->get();

        return view('home', compact('featuredDestinations'));
    }
}
