<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->get();
        return view('destinations.index', compact('destinations'));
    }

    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return view('destinations.show', compact('destination'));
    }

    public function create()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }
        return view('destinations.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'destination_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tour_duration' => 'required|integer|min:1',
            'max_travelers' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            $photos = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('destinations', 'public');
                    $photos[] = $path;
                }
            }

            $destination = Destination::create([
                'destination_name' => $validated['destination_name'],
                'location' => $validated['location'],
                'description' => $validated['description'],
                'photos' => $photos,
                'tour_duration' => $validated['tour_duration'],
                'max_travelers' => $validated['max_travelers'],
                'price' => $validated['price'],
            ]);

            return redirect()->route('destinations.index')
                ->with('success', 'Destination created successfully');
        } catch (\Exception $e) {
            // Clean up any uploaded photos if there's an error
            foreach ($photos ?? [] as $photo) {
                Storage::disk('public')->delete($photo);
            }
            return back()->withInput()->with('error', 'Error creating destination: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $this->authorize('update', $destination);

        return view('destinations.edit', compact('destination'));
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);
        $this->authorize('update', $destination);

        $validatedData = $request->validate([
            'destination_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'new_photos' => 'nullable|array',
            'new_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tour_duration' => 'required|integer|min:1',
            'max_travelers' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'remove_photos' => 'nullable|array',
        ]);

        $photos = $destination->photos ?? [];

        // Remove selected photos
        if ($request->has('remove_photos')) {
            foreach ($request->remove_photos as $index) {
                if (isset($photos[$index])) {
                    Storage::disk('public')->delete($photos[$index]);
                    unset($photos[$index]);
                }
            }
            $photos = array_values($photos); // Fixed: Changed array.values to array_values
        }

        // Add new photos
        if ($request->hasFile('new_photos')) {
            foreach ($request->file('new_photos') as $photo) {
                $path = $photo->store('destinations', 'public');
                $photos[] = $path;
            }
        }

        $destination->update([
            'destination_name' => $validatedData['destination_name'],
            'location' => $validatedData['location'],
            'description' => $validatedData['description'],
            'photos' => $photos,
            'tour_duration' => $validatedData['tour_duration'],
            'max_travelers' => $validatedData['max_travelers'],
            'price' => $validatedData['price'],
        ]);

        return redirect()->route('destinations.show', $destination->id)
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $this->authorize('delete', $destination);

        // Delete photos from storage
        if ($destination->photos) {
            foreach ($destination->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }

        $destination->delete();

        return redirect()->route('destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }

    public function like($id)
    {
        $destination = Destination::findOrFail($id);
        $user = Auth::user();

        if ($user->likedDestinations()->where('destination_id', $id)->exists()) {
            $user->likedDestinations()->detach($id);
            $destination->decrement('likes');
            $liked = false;
        } else {
            $user->likedDestinations()->attach($id);
            $destination->increment('likes');
            $liked = true;
        }

        return back()->with('success', $liked ? 'Added to likes' : 'Removed from likes');
    }
}
