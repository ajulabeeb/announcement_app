@extends('layouts.app')

@section('PageTitle', 'Active Announcements')

@section('container')
    <div class="container my-5">

        <!-- Active Announcements Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-4">Active Announcements</h1>
                <div class="list-group">
                    @foreach ($activeAnnouncements as $announcement)
                    <div class="list-group-item p-4 mb-3 shadow-sm border rounded">
                        <h4 class="fw-bold">{{ $announcement->title }}</h4>
                        <p class="mt-3">{{ $announcement->message }}</p>
                        <div class="mt-3 text-muted">
                            <small>Valid: {{ $announcement->start_date }} to {{ $announcement->end_date }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Back to All Announcements Link -->
        <div class="row">
            <div class="col-12">
                <a href="{{ route('announcements.index') }}" class="btn btn-secondary btn-lg w-100">Back to All Announcements</a>
            </div>
        </div>

    </div>
@endsection
