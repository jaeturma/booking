@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop
@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.classList.remove("hold-transition");
            document.querySelectorAll('.content-wrapper').forEach(el => {
                el.style.transition = 'none';
                el.style.animation = 'none';
            });
        });
    </script>
@stop
@section('content')
<div class="row">
    <!-- Users -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ \App\Models\User::count() }}</h3>
                <p>Users</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                Manage Users <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Roles -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ \Spatie\Permission\Models\Role::count() }}</h3>
                <p>Roles</p>
            </div>
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <a href="{{ route('admin.roles.index') }}" class="small-box-footer">
                Manage Roles <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Permissions -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ \Spatie\Permission\Models\Permission::count() }}</h3>
                <p>Permissions</p>
            </div>
            <div class="icon"><i class="fas fa-key"></i></div>
            <a href="{{ route('admin.permissions.index') }}" class="small-box-footer">
                Manage Permissions <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- ➕ Offices -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ \App\Models\Office::count() }}</h3>
                <p>Offices</p>
            </div>
            <div class="icon"><i class="fas fa-building"></i></div>
            <a href="{{ route('admin.offices.index') }}" class="small-box-footer">
                Manage Offices <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ \App\Models\Service::count() }}</h3>
                <p>Services</p>
            </div>
            <div class="icon"><i class="fas fa-concierge-bell"></i></div>
            <a href="{{ route('admin.services.index') }}" class="small-box-footer">
                Manage Services <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

@stop

