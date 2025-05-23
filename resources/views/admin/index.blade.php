@extends('layouts.admin')

@section('title')
    Administration - TAMA EL PABLO Professional
@endsection

@section('content-header')
    <h1>Administrative Overview<small>Professional server management interface by TAMA EL PABLO</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Overview</li>
    </ol>
@endsection

@section('content')
<div class="dashboard-stats fade-in-up">
    <div class="stat-card">
        <div class="stat-label">Active Nodes</div>
        <div class="stat-number" data-count="0">0</div>
        <div class="stat-description">Infrastructure endpoints</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.1s;">
        <div class="stat-label">Total Servers</div>
        <div class="stat-number" data-count="0">0</div>
        <div class="stat-description">Managed instances</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.2s;">
        <div class="stat-label">Registered Users</div>
        <div class="stat-number" data-count="0">0</div>
        <div class="stat-description">Platform accounts</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.3s;">
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
            You are running Pterodactyl Panel version <code>{{ config('app.version') }}</code>. Your panel is up-to-date and running optimally with TAMA EL PABLO Professional Theme.
        </p>
    @else
        <p class="status-content">
            <i class="fa fa-exclamation-triangle" style="color: var(--accent-warning); margin-right: 8px;"></i>
            Your panel requires updating. The latest version is 
            <a href="https://github.com/Pterodactyl/Panel/releases/v{{ $version->getPanel() }}" target="_blank" style="color: var(--brand-primary); text-decoration: none; font-weight: 500;">
                <code>{{ $version->getPanel() }}</code>
            </a> 
            and you are currently running version 
            <code>{{ config('app.version') }}</code>.
        </p>
    @endif
    <div style="margin-top: 16px; padding: 12px; background: linear-gradient(135deg, rgba(0, 212, 255, 0.1), rgba(255, 107, 53, 0.1)); border-radius: 8px; border-left: 4px solid var(--brand-primary);">
        <strong style="color: var(--brand-primary);">TAMA EL PABLO Professional Theme</strong> - Optimized UI/UX with lightweight background and enhanced performance.
    </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lightweight number animation
    const counters = document.querySelectorAll('.stat-number[data-count]');
    counters.forEach((counter, index) => {
        const target = parseInt(counter.getAttribute('data-count'));
        if (target > 0) {
            setTimeout(() => {
                let current = 0;
                const increment = target / 40; // Faster animation
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 25);
            }, index * 100); // Faster stagger
        }
    });
});
</script>
@endsection
