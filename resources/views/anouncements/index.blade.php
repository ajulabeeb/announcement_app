@extends('layouts.app')

@section('PageTitle', 'Announcements')

@section('container')
<div class="container py-5">

    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">📢 All Announcements</h1>
        <p class="text-muted">Manage and view all announcements here.</p>
    </div>

    <!-- Announcements List -->
    <div class="row g-4 mb-5">
        @forelse ($announcements as $announcement)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title fw-semibold">{{ $announcement->title }}</h5>
                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                &times;
                            </button>
                        </form>
                    </div>
                    <p class="card-text mt-3">{{ $announcement->message }}</p>
                </div>
                <div class="card-footer bg-white border-0 text-end">
                    <small class="text-muted">
                        🗓 {{ \Carbon\Carbon::parse($announcement->start_date)->format('M d, Y') }}
                        - {{ \Carbon\Carbon::parse($announcement->end_date)->format('M d, Y') }}
                    </small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No announcements available.
            </div>
        </div>
        @endforelse
    </div>

    <!-- View Active Announcements Button -->
    <div class="text-center mb-5">
        <a href="{{ route('announcements.active') }}" class="btn btn-outline-primary btn-lg px-5 rounded-pill">
            🚀 View Active Announcements
        </a>
    </div>

    <!-- Add New Announcement -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h4 class="card-title fw-bold mb-4 text-center">➕ Add New Announcement</h4>
                    <form action="{{ route('announcements.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control form-control-lg rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" rows="4" class="form-control rounded-3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill mt-3">
                            ✅ Create Announcement
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
