@extends('layouts.app')

@section('page_title')Order Successful @endsection

@section('specific-cdns')
    {{-- Sweet Alert CDN --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('page_content')
    <div class="wrapper">
        <div class="card text-center">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">
                2 days ago
            </div>
        </div>
    </div>
@endsection

@section('end_page_scripts')
    <script src="sweetalert2.all.min.js"></script>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Payment Successful',
            icon: 'success',
            confirmButtonText: 'View Order'
        })
    </script>
@endsection

