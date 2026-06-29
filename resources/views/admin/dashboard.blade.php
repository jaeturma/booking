@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @if($isValidator)
        <h1>Booking Summary &mdash; {{ $officeName }}</h1>
    @else
        <h1>Admin Dashboard</h1>
    @endif
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

@if($isValidator)
{{-- Validator: today's booking stats for their office only --}}
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pendingToday }}</h3>
                <p>Pending Today</p>
            </div>
            <div class="icon"><i class="fas fa-clock"></i></div>
            <a href="{{ route('admin.transactions.index') }}" class="small-box-footer">
                View Transactions <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $validatedToday }}</h3>
                <p>Validated Today</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
            <a href="{{ route('admin.transactions.index') }}" class="small-box-footer">
                View Transactions <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalToday }}</h3>
                <p>Total Bookings Today</p>
            </div>
            <div class="icon"><i class="fas fa-receipt"></i></div>
            <a href="{{ route('admin.transactions.index') }}" class="small-box-footer">
                View Transactions <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@else
{{-- Admin / CA: system-wide stats --}}
<div class="row">
    @can('manage-users')
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $userCount }}</h3>
                <p>Users</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                Manage Users <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    @endcan
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $officeCount }}</h3>
                <p>Offices</p>
            </div>
            <div class="icon"><i class="fas fa-building"></i></div>
            <a href="{{ route('admin.offices.index') }}" class="small-box-footer">
                View Offices <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $serviceCount }}</h3>
                <p>Services</p>
            </div>
            <div class="icon"><i class="fas fa-concierge-bell"></i></div>
            <a href="{{ route('admin.services.index') }}" class="small-box-footer">
                View Services <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pendingCount }}</h3>
                <p>Pending Transactions</p>
            </div>
            <div class="icon"><i class="fas fa-receipt"></i></div>
            <a href="{{ route('admin.transactions.index') }}" class="small-box-footer">
                View Transactions <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $validatedToday }}</h3>
                <p>Validated Today</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
            <a href="{{ route('admin.transactions.index') }}" class="small-box-footer">
                View Transactions <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@endif

@stop
