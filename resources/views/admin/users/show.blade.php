@extends('adminlte::page')

@section('title', 'User Details')

@section('content_header')
    <h1>User Details</h1>
@stop

@section('content')

<ul class="list-group">
    <li class="list-group-item"><strong>Employee No:</strong> {{ $user->employee_no }}</li>
    <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
    <li class="list-group-item"><strong>Position:</strong> {{ optional($user->position)->name }}</li>
    <li class="list-group-item"><strong>Office:</strong> {{ optional($user->office)->name }}</li>
    <li class="list-group-item"><strong>Roles:</strong>
        @foreach($user->roles as $role)
            <span class="badge bg-success">{{ $role->name }}</span>
        @endforeach
    </li>
</ul>

@stop