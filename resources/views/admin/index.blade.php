@extends('layouts.admin')

@section('title')
    Administration
@endsection

@section('content-header')
    <h1>Administrative Overview<small>Control panel</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Overview</li>
    </ol>
@endsection

@section('content')
<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-label">Active Nodes</div>
        <div class="stat-number" data-count="{{ DB::table("nodes")->count() }}">0</div>
        <div class="stat-description">Infrastructure endpoints</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Servers</div>
        <div class="stat-number" data-count="{{ DB::table("servers")->count() }}">0</div>
        <div class="stat-description">Managed instances</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Registered Users</div>
        <div class="stat-number" data-count="{{ DB::table("users")->count() }}">0</div>
        <div class="stat-description">Platform accounts</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Allocations</div>
        <div class="stat-number" data-count="{{ DB::table("allocations")->count() }}">0</div>
        <div class="stat-description">Network resources</div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-info-circle"></i>
                    System Information
                </h3>
            </div>
            <div class="box-body">
                @if ($version->isLatestPanel())
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i>
                        You are running Pterodactyl Panel version <code>{{ config('app.version') }}</code>. Your panel is up-to-date!
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        Your panel version <code>{{ config('app.version') }}</code> is outdated. Latest version: 
                        <a href="https://github.com/Pterodactyl/Panel/releases/v{{ $version->getPanel() }}" target="_blank">
                            <code>{{ $version->getPanel() }}</code>
                        </a>
                    </div>
                @endif
                <div class="alert alert-info">
                    <strong>TAMA EL PABLO Professional Theme</strong> - Enhanced with cinematic background and real-time statistics.
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Quick Stats</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green">
                                <i class="fa fa-caret-up"></i> {{ DB::table("servers")->count() }}
                            </span>
                            <h5 class="description-header">{{ DB::table("servers")->count() }}</h5>
                            <span class="description-text">SERVERS</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-blue">
                                <i class="fa fa-caret-up"></i> {{ DB::table("users")->count() }}
                            </span>
                            <h5 class="description-header">{{ DB::table("users")->count() }}</h5>
                            <span class="description-text">USERS</span>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-yellow">
                                <i class="fa fa-caret-up"></i> {{ DB::table("nodes")->count() }}
                            </span>
                            <h5 class="description-header">{{ DB::table("nodes")->count() }}</h5>
                            <span class="description-text">NODES</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="description-block">
                            <span class="description-percentage text-red">
                                <i class="fa fa-caret-up"></i> {{ app('Pterodactyl\Models\Database')->count() }}
                            </span>
                            <h5 class="description-header">{{ DB::table("allocations")->count() }}</h5>
                            <span class="description-text">ALLOCATIONS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(app('Pterodactyl\Models\Server')->count() > 0)
<div class="row">
    <div class="col-lg-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Servers</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Server</th>
                            <th>Owner</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(app('Pterodactyl\Models\Server')->with('user')->latest()->limit(5)->get() as $server)
                        <tr>
                            <td>
                                <a href="{{ route('admin.servers.view', $server->id) }}">
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
    
    <div class="col-lg-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Users</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(app('Pterodactyl\Models\User')->latest()->limit(5)->get() as $user)
                        <tr>
                            <td>
                                <a href="{{ route('admin.users.view', $user->id) }}">
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
@endif

<div style="position: fixed; bottom: 10px; left: 10px; background: rgba(0, 0, 0, 0.7); color: #00d4ff; padding: 5px 10px; border-radius: 5px; font-size: 12px; z-index: 999;">
    ⚡ TAMA EL PABLO
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.stat-number[data-count]');
    counters.forEach((counter, index) => {
        const target = parseInt(counter.getAttribute('data-count'));
        setTimeout(() => {
            let current = 0;
            const increment = Math.max(1, target / 50);
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current);
            }, 30);
        }, index * 100);
    });
    console.log('📊 Real stats loaded - TAMA EL PABLO');
});
</script>
@endsection
