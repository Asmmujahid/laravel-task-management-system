@extends('layout.app')

@section('title', 'About Us')

@section('content')

<section class="page-banner">

    <div class="banner-content">

        <span class="banner-badge">
            About Our Platform
        </span>

        <h1>
            Empowering Teams Through
            Better Task Management
        </h1>

        <p>
            We help organizations streamline projects,
            improve collaboration, and boost productivity.
        </p>

    </div>

</section>

<section class="about-modern-section">

    <div class="about-modern-grid">

        <div class="about-left">

            <h2>Who We Are</h2>

            <p>
                Task Management System is a modern collaboration
                platform designed to help organizations manage
                projects, teams, and productivity from a single place.
            </p>

            <p>
                Our mission is to simplify project planning,
                task assignments, communication, and reporting
                through an intuitive user experience.
            </p>

            <div class="about-stats">

                <div class="stat-card">
                    <h3>100+</h3>
                    <span>Projects</span>
                </div>

                <div class="stat-card">
                    <h3>50+</h3>
                    <span>Teams</span>
                </div>

                <div class="stat-card">
                    <h3>99%</h3>
                    <span>Satisfaction</span>
                </div>

            </div>

        </div>

        <div class="about-right">

            <div class="about-feature-card">
                <i class="fa-solid fa-diagram-project"></i>
                <h3>Project Planning</h3>
                <p>Create structured workflows easily.</p>
            </div>

            <div class="about-feature-card">
                <i class="fa-solid fa-users"></i>
                <h3>Team Collaboration</h3>
                <p>Connect and work efficiently together.</p>
            </div>

            <div class="about-feature-card">
                <i class="fa-solid fa-chart-line"></i>
                <h3>Performance Tracking</h3>
                <p>Monitor team productivity in real-time.</p>
            </div>

        </div>

    </div>

</section>

<section class="mission-modern">

    <div class="mission-card-modern">

        <h2>Our Mission</h2>

        <p>
            To deliver a powerful, secure, and user-friendly task
            management platform that enables teams to achieve more
            through collaboration, transparency, and efficiency.
        </p>

    </div>

</section>

@endsection