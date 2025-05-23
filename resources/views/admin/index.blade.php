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
        <div class="stat-number" data-count="{{ \Pterodactyl\Models\Node::count() }}">0</div>
        <div class="stat-description">Infrastructure endpoints</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.1s;">
        <div class="stat-label">Total Servers</div>
        <div class="stat-number" data-count="{{ \Pterodactyl\Models\Server::count() }}">0</div>
        <div class="stat-description">Managed instances</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.2s;">
        <div class="stat-label">Registered Users</div>
        <div class="stat-number" data-count="{{ \Pterodactyl\Models\User::count() }}">0</div>
        <div class="stat-description">Platform accounts</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.3s;">
        <div class="stat-label">Total Allocations</div>
        <div class="stat-number" data-count="{{ \Pterodactyl\Models\Allocation::count() }}">0</div>
        <div class="stat-description">Network resources</div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
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
                <strong style="color: var(--brand-primary);">TAMA EL PABLO Professional Theme</strong> - Enhanced UI/UX with cinematic video background and real-time statistics.
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="box box-primary fade-in-up" style="animation-delay: 0.4s;">
            <div class="box-header with-border">
                <h3 class="box-title">Quick Stats</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green">
                                <i class="fa fa-caret-up"></i> {{ \Pterodactyl\Models\Server::where('suspended', 0)->count() }}
                            </span>
                            <h5 class="description-header">{{ \Pterodactyl\Models\Server::count() }}</h5>
                            <span class="description-text">TOTAL SERVERS</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-blue">
                                <i class="fa fa-caret-up"></i> {{ \Pterodactyl\Models\User::where('root_admin', 1)->count() }}
                            </span>
                            <h5 class="description-header">{{ \Pterodactyl\Models\User::count() }}</h5>
                            <span class="description-text">TOTAL USERS</span>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-yellow">
                                <i class="fa fa-caret-up"></i> {{ \Pterodactyl\Models\Node::where('maintenance_mode', 0)->count() }}
                            </span>
                            <h5 class="description-header">{{ \Pterodactyl\Models\Node::count() }}</h5>
                            <span class="description-text">TOTAL NODES</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-red">
                                <i class="fa fa-caret-up"></i> {{ \Pterodactyl\Models\Database::count() }}
                            </span>
                            <h5 class="description-header">{{ \Pterodactyl\Models\Allocation::count() }}</h5>
                            <span class="description-text">ALLOCATIONS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(\Pterodactyl\Models\Server::count() > 0)
<div class="row">
    <div class="col-lg-6">
        <div class="box box-primary fade-in-up" style="animation-delay: 0.5s;">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Servers</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Server</th>
                                <th>Owner</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\Pterodactyl\Models\Server::with('user')->latest()->limit(5)->get() as $server)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.servers.view', $server->id) }}" style="color: var(--brand-primary);">
                                        {{ $server->name }}
                                    </a>
                                </td>
                                <td>{{ $server->user->username }}</td>
                                <td>
                                    @if($server->isSuspended())
                                        <span class="label label-warning">Suspended</span>
                                    @elseif(!$server->isInstalled())
                                        <span class="label label-info">Installing</span>
                                    @else
                                        <span class="label label-success">Active</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="box box-primary fade-in-up" style="animation-delay: 0.6s;">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Users</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\Pterodactyl\Models\User::latest()->limit(5)->get() as $user)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.users.view', $user->id) }}" style="color: var(--brand-primary);">
                                        {{ $user->username }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->root_admin)
                                        <span class="label label-danger">Admin</span>
                                    @else
                                        <span class="label label-default">User</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- TAMA EL PABLO Watermark -->
<div class="tama-watermark">
    ⚡ TAMA EL PABLO
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate real numbers
    const counters = document.querySelectorAll('.stat-number[data-count]');
    counters.forEach((counter, index) => {
        const target = parseInt(counter.getAttribute('data-count'));
        
        setTimeout(() => {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current);
            }, 30);
        }, index * 150);
    });
    
    console.log('📊 Real stats loaded successfully');
});
</script>
@endsection
