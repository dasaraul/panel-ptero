@extends('layouts.admin')

@section('title')
    Administration - TAMA EL PABLO
@endsection

@section('content-header')
    <h1>Administrative Overview<small>Professional server management interface</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Overview</li>
    </ol>
@endsection

@section('content')
<!-- Video Background -->
<div class="video-background">
    <iframe 
        src="https://www.youtube.com/embed/41cr-O-mW2k?autoplay=1&mute=1&loop=1&playlist=41cr-O-mW2k&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&disablekb=1&fs=0&cc_load_policy=0&start=0&end=0"
        frameborder="0" 
        allow="autoplay; encrypted-media" 
        allowfullscreen>
    </iframe>
</div>
<div class="video-overlay"></div>

<div class="dashboard-stats fade-in-up">
    <div class="stat-card floating">
        <div class="stat-label">Active Nodes</div>
        <div class="stat-number" data-count="0">0</div>
        <div class="stat-description">Infrastructure endpoints</div>
    </div>
    <div class="stat-card floating" style="animation-delay: 0.2s;">
        <div class="stat-label">Total Servers</div>
        <div class="stat-number" data-count="0">0</div>
        <div class="stat-description">Managed instances</div>
    </div>
    <div class="stat-card floating" style="animation-delay: 0.4s;">
        <div class="stat-label">Registered Users</div>
        <div class="stat-number" data-count="0">0</div>
        <div class="stat-description">Platform accounts</div>
    </div>
    <div class="stat-card floating" style="animation-delay: 0.6s;">
        <div class="stat-label">Total Allocations</div>
        <div class="stat-number" data-count="0">0</div>
        <div class="stat-description">Network resources</div>
    </div>
</div>

<div class="system-status @if($version->isLatestPanel()) up-to-date @else outdated @endif fade-in-up">
    <h3 class="status-title">
        <i class="fa fa-info-circle"></i>
        System Information
    </h3>
    @if ($version->isLatestPanel())
        <p class="status-content">
            <i class="fa fa-check-circle" style="color: var(--accent-success); margin-right: 8px;"></i>
            You are running Pterodactyl Panel version <code>{{ config('app.version') }}</code>. Your panel is up-to-date and running optimally.
        </p>
    @else
        <p class="status-content">
            <i class="fa fa-exclamation-triangle" style="color: var(--accent-warning); margin-right: 8px;"></i>
            Your panel requires updating. The latest version is 
            <a href="https://github.com/Pterodactyl/Panel/releases/v{{ $version->getPanel() }}" target="_blank" style="color: var(--accent-primary); text-decoration: none; font-weight: 500;">
                <code>{{ $version->getPanel() }}</code>
            </a> 
            and you are currently running version 
            <code>{{ config('app.version') }}</code>.
        </p>
    @endif
</div>

<div class="action-grid fade-in-up">
    <a href="{{ $version->getDiscord() }}" class="action-card" target="_blank">
        <i class="fa fa-life-ring action-icon"></i>
        <div class="action-title">Get Support</div>
        <div class="action-description">Connect with our community via Discord for assistance and guidance</div>
    </a>
    
    <a href="https://pterodactyl.io" class="action-card" target="_blank">
        <i class="fa fa-book action-icon"></i>
        <div class="action-title">Documentation</div>
        <div class="action-description">Comprehensive guides and API references for developers</div>
    </a>
    
    <a href="https://github.com/pterodactyl/panel" class="action-card" target="_blank">
        <i class="fa fa-github action-icon"></i>
        <div class="action-title">Source Code</div>
        <div class="action-description">Explore the open-source codebase and contribute to development</div>
    </a>
    
    <a href="{{ $version->getDonations() }}" class="action-card" target="_blank">
        <i class="fa fa-heart action-icon"></i>
        <div class="action-title">Support Project</div>
        <div class="action-description">Help sustain development through donations and sponsorships</div>
    </a>
</div>

<!-- TAMA EL PABLO Signature -->
<div class="tama-signature">
    TAMA EL PABLO Custom Design
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate numbers with stagger effect
    const counters = document.querySelectorAll('.stat-number[data-count]');
    counters.forEach((counter, index) => {
        const target = parseInt(counter.getAttribute('data-count'));
        if (target > 0) {
            setTimeout(() => {
                let current = 0;
                const increment = target / 60;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 25);
            }, index * 300);
        }
    });
    
    // Add parallax effect to floating elements
    let ticking = false;
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const floatingElements = document.querySelectorAll('.floating');
        
        floatingElements.forEach((element, index) => {
            const speed = 0.5 + (index * 0.1);
            const yPos = -(scrolled * speed * 0.05);
            element.style.transform = `translateY(${yPos}px)`;
        });
        ticking = false;
    }
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    });
});
</script>

<style>
/* Additional specific overrides untuk dashboard */
.dashboard-stats .stat-card {
    animation-fill-mode: both;
}

.action-grid .action-card {
    animation: fadeInUp 0.8s ease-out;
    animation-fill-mode: both;
}

.action-grid .action-card:nth-child(1) { animation-delay: 0.1s; }
.action-grid .action-card:nth-child(2) { animation-delay: 0.2s; }
.action-grid .action-card:nth-child(3) { animation-delay: 0.3s; }
.action-grid .action-card:nth-child(4) { animation-delay: 0.4s; }
</style>
@endsection
