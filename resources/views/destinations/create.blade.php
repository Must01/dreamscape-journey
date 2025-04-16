@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Add New Destination</h1>

        <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Destination Name</label>
                <input type="text" name="destination_name" required
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Location</label>
                <input type="text" name="location" required
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" required
                    class="w-full px-3 py-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Photos</label>
                <input type="file" name="photos[]" multiple accept="image/*" required
                    class="w-full px-3 py-2 border rounded bg-white">
                <p class="text-sm text-gray-500 mt-1">You can select multiple images (maximum 5)</p>
                <div id="imagePreview" class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-4"></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Tour Duration (days)</label>
                    <input type="number" name="tour_duration" required min="1"
                        class="w-full px-3 py-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Maximum Travelers</label>
                    <input type="number" name="max_travelers" required min="1"
                        class="w-full px-3 py-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Price per Person</label>
                    <input type="number" name="price" required min="0" step="0.01"
                        class="w-full px-3 py-2 border rounded">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Create Destination
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const input = document.querySelector('input[type="file"]');
    const preview = document.getElementById('imagePreview');

    input.addEventListener('change', function() {
        preview.innerHTML = '';
        const files = Array.from(this.files);

        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-full', 'h-32', 'object-cover', 'rounded');
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush