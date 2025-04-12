@extends('layouts.app')

@section('PageTitle', 'Active Announcements')

@section('container')
<div class="container py-5">

    <!-- Title -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">📢 Active Announcements</h1>
        <p class="text-muted">Stay informed with the latest updates.</p>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Announcements List -->
    <div class="row g-4">
        @forelse ($activeAnnouncements as $announcement)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-3">{{ $announcement->title }}</h5>
                    <p class="card-text">{{ $announcement->message }}</p>
                </div>
                <div class="card-footer bg-white border-0 text-end">
                    <small class="text-muted">🗓 {{ \Carbon\Carbon::parse($announcement->start_date)->format('M d, Y') }}
                        - {{ \Carbon\Carbon::parse($announcement->end_date)->format('M d, Y') }}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No active announcements available.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Back Button -->
    <div class="mt-5 text-center">
        <a href="{{ route('announcements.index') }}" class="btn btn-outline-primary btn-lg px-5 rounded-pill">
            ← Back to All Announcements
        </a>
    </div>

</div>
@endsection
