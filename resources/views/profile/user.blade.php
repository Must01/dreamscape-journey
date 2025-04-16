@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Cover Image -->
        <div class="h-48 bg-gray-200 relative">
            @if($user->cover_picture)
                <img src="{{ asset('storage/' . $user->cover_picture) }}" class="w-full h-full object-cover" alt="Cover">
            @endif
        </div>
        
        <!-- Profile Section -->
        <div class="relative px-6 py-4">
            <!-- Profile Picture -->
            <div class="absolute -top-16 left-6">
                <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden bg-gray-100">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="w-full h-full object-cover" alt="Profile">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- User Info -->
            <div class="mt-16">
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>

            <!-- Profile Actions -->
            <div class="mt-6 flex flex-wrap gap-4">
                <button onclick="document.getElementById('edit-profile-modal').classList.remove('hidden')" 
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Edit Profile
                </button>
                <button onclick="document.getElementById('change-password-modal').classList.remove('hidden')"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Change Password
                </button>
            </div>
        </div>

        <!-- User Activity -->
        <div class="border-t mt-6">
            <div class="px-6 py-4">
                <h2 class="text-xl font-semibold mb-4">My Bookings</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($user->bookings as $booking)
                        <div class="border rounded-lg p-4">
                            <h3 class="font-semibold">{{ $booking->destination->destination_name }}</h3>
                            <p class="text-sm text-gray-600">{{ $booking->check_in->format('M d, Y') }} - {{ $booking->check_out->format('M d, Y') }}</p>
                            <p class="text-sm">{{ $booking->number_travelers }} travelers</p>
                            <span class="inline-block mt-2 px-2 py-1 text-xs rounded {{ $booking->paid ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $booking->paid ? 'Paid' : 'Pending Payment' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500">No bookings yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->is_admin)
    <!-- Admin Destinations Section -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mt-8">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Manage Destinations</h2>
                <button onclick="document.getElementById('add-destination-modal').classList.remove('hidden')"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Add New Destination
                </button>
            </div>

            <!-- Sample Destination Templates -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-lg mb-2">Paris, France</h3>
                    <p class="text-gray-600">Romantic city break with Eiffel Tower views</p>
                    <p class="text-sm mt-2">Duration: 3 days</p>
                    <p class="text-sm">Price: $599</p>
                </div>
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-lg mb-2">Bali, Indonesia</h3>
                    <p class="text-gray-600">Tropical paradise with beautiful beaches</p>
                    <p class="text-sm mt-2">Duration: 7 days</p>
                    <p class="text-sm">Price: $1299</p>
                </div>
                <!-- Add more templates as needed -->
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Edit Profile Modal -->
<div id="edit-profile-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h2 class="text-xl font-bold mb-4">Edit Profile</h2>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full px-3 py-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full px-3 py-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Profile Picture</label>
                    <input type="file" name="profile_picture" accept="image/*" class="w-full">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">New Password</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border rounded">
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" onclick="this.closest('#change-password-modal').classList.add('hidden')"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection