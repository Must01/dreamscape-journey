@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Contact Us</h1>
</div>

<div class="page-content">
    <div class="section">
        <h2 class="section-title">Get in Touch</h2>
        <p class="section-description">Have questions? We're here to help!</p>

        <div class="grid-container">
            <div class="contact-info card">
                <div class="card-content">
                    <div class="contact-details">
                        <div class="contact-item">
                            <span class="icon">📍</span>
                            <p>123 Travel Street, Adventure City, AC 12345</p>
                        </div>
                        <div class="contact-item">
                            <span class="icon">📞</span>
                            <p>+1 234 567 890</p>
                        </div>
                        <div class="contact-item">
                            <span class="icon">📧</span>
                            <p>info@dreamscape.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-container">
                <form class="contact-form">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-input" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection