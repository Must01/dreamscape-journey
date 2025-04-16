<div class="review-card">
    <div class="review-header">
        <div class="reviewer-info">
            <img src="{{ Storage::url($review->user->profile_picture) }}" alt="{{ $review->user->name }}" class="reviewer-avatar">
            <span class="reviewer-name">{{ $review->user->name }}</span>
        </div>
        <div class="review-rating">
            @for($i = 1; $i <= 5; $i++)
                <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">⭐</span>
            @endfor
        </div>
    </div>
    <div class="review-content">
        <p>{{ $review->comment }}</p>
    </div>
    <div class="review-footer">
        <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
        @if(Auth::id() === $review->user_id || Auth::user()?->is_admin)
            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link text-danger">Delete</button>
            </form>
        @endif
    </div>
</div>
