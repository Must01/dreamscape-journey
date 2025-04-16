@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">About Dreamscape Journey</h1>
</div>

<div class="page-content">
    <div class="section">
        <div class="grid-container">
            <div class="about-text">
                <h2 class="section-title">Our Story</h2>
                <p class="section-description">Dreamscape Journey was founded with a simple mission: to make travel accessible,
                    enjoyable, and memorable for everyone.</p>

                <h2 class="section-title">Our Mission</h2>
                <p class="section-description">To provide exceptional travel experiences that inspire, educate, and connect
                    people from all walks of life.</p>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">1000+</div>
            <div class="stat-label">Happy Travelers</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">50+</div>
            <div class="stat-label">Destinations</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">100%</div>
            <div class="stat-label">Satisfaction</div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Why Choose Us</h2>
        <div class="grid-container">
            <div class="card">
                <div class="card-content">
                    <h3 class="card-title">Curated Destinations</h3>
                    <p>Handpicked locations that offer unique and authentic experiences.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3 class="card-title">Expert Guides</h3>
                    <p>Professional local guides who know their destinations inside out.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3 class="card-title">24/7 Support</h3>
                    <p>Round-the-clock assistance for any questions or concerns.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection