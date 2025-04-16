@extends('layouts.app')

@section('content')
<div class="profile-header">
    <div class="container">
        <div class="profile-info">
            <div class="profile-avatar">
                @if(auth()->user()->profile_picture)
                <img src="{{ Storage::url(auth()->user()->profile_picture) }}" alt="Profile">
                @else
                <div class="default-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                @endif
            </div>
            <div class="profile-details">
                <h1 class="profile-name">{{ auth()->user()->name }}</h1>
                <p class="profile-email">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</div>

<div class="profile-tabs">
    <div class="container">
        <nav class="tabs-nav">
            <a href="#profile" class="tab-link active" data-section="profile-section">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="#bookings" class="tab-link" data-section="bookings-section">
                <i class="fas fa-calendar"></i> My Bookings
            </a>
            @if(auth()->user()->is_admin)
            <a href="#destinations" class="tab-link" data-section="destinations-section">
                <i class="fas fa-map-marker-alt"></i> Manage Destinations
            </a>
            @endif
        </nav>
    </div>
</div>

<div class="profile-container">
    <div class="container">
        <!-- Profile Section -->
        <div class="profile-section active" id="profile-section">
            <div class="content-card">
                <h2 class="section-title">Update Profile</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Profile Picture</label>
                        <div class="drag-drop-zone">
                            <input type="file" name="profile_picture" accept="image/*" class="form-input">
                            <p>Drop your image here or click to select</p>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>

        <!-- Bookings Section -->
        <div class="profile-section" id="bookings-section">
            <div class="content-card">
                <h2 class="section-title">My Bookings</h2>
                @if($bookings->count() > 0)
                <div class="bookings-grid">
                    @foreach($bookings as $booking)
                    <div class="destination-card">
                        <div class="card-image">
                            <img src="{{ $booking->destination->first_photo_url }}" alt="{{ $booking->destination->destination_name }}">
                        </div>
                        <div class="card-content">
                            <h3>{{ $booking->destination->destination_name }}</h3>
                            <div class="card-meta">
                                <span>{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</span>
                                <span class="status {{ $booking->paid ? 'paid' : 'pending' }}">
                                    {{ $booking->paid ? 'Paid' : 'Pending' }}
                                </span>
                            </div>
                            <div class="card-footer">
                                <span class="price">${{ number_format($booking->price, 2) }}</span>
                                <a href="{{ route('bookings.show', $booking->id) }}" class="card-button">View Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon">📅</div>
                    <h3>No Bookings Yet</h3>
                    <p>Start exploring destinations and book your next adventure!</p>
                    <a href="{{ route('destinations.index') }}" class="btn btn-primary">Browse Destinations</a>
                </div>
                @endif
            </div>
        </div>

        <!-- Admin Destinations Section -->
        @if(auth()->user()->is_admin)
        <div class="profile-section" id="destinations-section">
            <div class="content-card">
                <h2 class="section-title">Add New Destination</h2>
                <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Destination Name</label>
                        <input type="text" name="destination_name" value="{{ old('destination_name') }}" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" required class="form-input" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Photos</label>
                        <div class="drag-drop-zone">
                            <input type="file" name="photos[]" multiple accept="image/*" required class="form-input">
                            <p>Drop destination photos here or click to select</p>
                        </div>
                        <div class="image-preview" id="imagePreview"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tour Duration (days)</label>
                        <input type="number" name="tour_duration" value="{{ old('tour_duration') }}" required min="1" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Maximum Travelers</label>
                        <input type="number" name="max_travelers" value="{{ old('max_travelers') }}" required min="1" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Price per Person</label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0" step="0.01" class="form-input">
                    </div>

                    <button type="submit" class="btn btn-primary">Create Destination</button>
                </form>

                @if($errors->any())
                <div class="alert alert-error mt-4">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-link');
        const sections = document.querySelectorAll('.profile-section');

        // Show active section from URL hash or default to profile
        const showSection = (sectionId) => {
            tabs.forEach(t => t.classList.remove('active'));
            sections.forEach(s => s.classList.remove('active'));

            const tab = document.querySelector(`[data-section="${sectionId}"]`);
            const section = document.getElementById(sectionId);

            if (tab && section) {
                tab.classList.add('active');
                section.classList.add('active');
            }
        };

        // Handle tab clicks
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const sectionId = tab.dataset.section;
                showSection(sectionId);
                history.pushState(null, '', `#${sectionId.replace('-section', '')}`);
            });
        });

        // Show section based on URL hash on page load
        const hash = window.location.hash.replace('#', '') || 'profile';
        showSection(`${hash}-section`);

        // Image preview functionality
        const photoInput = document.querySelector('input[name="photos[]"]');
        const imagePreview = document.getElementById('imagePreview');

        if (photoInput) {
            photoInput.addEventListener('change', function() {
                imagePreview.innerHTML = '';
                const files = Array.from(this.files);

                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'preview-image';
                        div.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                        imagePreview.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            });
        }
    });
</script>
@endpush

@endsection