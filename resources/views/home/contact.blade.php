@extends('layout.app')

@section('title', 'Contact Us')

@section('content')

<section class="page-banner">

    <div class="banner-content">

        <span class="banner-badge">
            Contact Us
        </span>

        <h1>
            Let's Start A Conversation
        </h1>

        <p>
            We're here to help and answer any questions you may have.
        </p>

    </div>

</section>

<section class="contact-modern-section">

    <div class="contact-modern-grid">

        <div class="contact-info-modern">

            <h2>Get In Touch</h2>

            <p>
                Feel free to contact us regarding any issue,
                suggestion, partnership, or support request.
            </p>

            <div class="contact-box">

                <i class="fa-solid fa-envelope"></i>

                <div>
                    <h4>Email</h4>
                    <span>support@tms.com</span>
                </div>

            </div>

            <div class="contact-box">

                <i class="fa-solid fa-phone"></i>

                <div>
                    <h4>Phone</h4>
                    <span>+92 300 1234567</span>
                </div>

            </div>

            <div class="contact-box">

                <i class="fa-solid fa-location-dot"></i>

                <div>
                    <h4>Location</h4>
                    <span>Karachi, Pakistan</span>
                </div>

            </div>

        </div>

        <div class="contact-form-modern">

            <form>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control">
                </div>

                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Message</label>
                    <textarea rows="5" class="form-control"></textarea>
                </div>

                <button class="btn btn-primary">
                    <i class="fa-solid fa-paper-plane"></i>
                    Send Message
                </button>

            </form>

        </div>

    </div>

</section>

@endsection