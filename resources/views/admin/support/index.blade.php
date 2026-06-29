@extends('adminlte::page')

@section('title', 'Support')

@section('content_header')@stop

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Support</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-headset mr-2"></i>Technical Support</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><i class="fas fa-envelope mr-2 text-muted"></i> <strong>Email:</strong> itsupport@deped.gov.ph</p>
                        <p class="mb-1"><i class="fas fa-phone mr-2 text-muted"></i> <strong>Phone:</strong> (123) 456-7890</p>
                        <p class="mb-0"><i class="fas fa-clock mr-2 text-muted"></i> <strong>Hours:</strong> Monday – Friday, 8:00 AM – 5:00 PM</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>System Information</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>System:</strong> DepEd Division Office Booking System</p>
                        <p class="mb-1"><strong>Version:</strong> 1.0.0</p>
                        <p class="mb-0"><strong>Framework:</strong> Laravel {{ app()->version() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-warning mt-2">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book mr-2"></i>Quick Help</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="font-weight-bold">Booking Transactions</h6>
                        <p class="small text-muted">View and manage all booking requests. Use the Validate button to approve a booking, or Hide to remove it from office views.</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold">Certificate of Appearance</h6>
                        <p class="small text-muted">View today's unprinted certificates. Use Fresh print for a clean copy or E-Sign for the digital signature version.</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold">Survey Responses</h6>
                        <p class="small text-muted">View client satisfaction survey submissions. Click Responses on any row to see the detailed question-and-answer breakdown.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
