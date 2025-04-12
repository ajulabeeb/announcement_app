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

                    <!-- Shortened Message -->
                    <p class="card-text mt-3" id="message-{{ $announcement->id }}">
                        {{ substr($announcement->message, 0, 150) }} <!-- Truncate to 150 characters -->
                        @if(strlen($announcement->message) > 150) <!-- Check if message is longer than 150 characters -->
                        <a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#announcementModal"
                            data-title="{{ $announcement->title }}"
                            data-message="{{ $announcement->message }}"
                            data-start-date="{{ $announcement->start_date }}"
                            data-end-date="{{ $announcement->end_date }}">View More</a>
                        @endif
                    </p>

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

<!-- Modal for Announcement Details -->
<div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel">Announcement Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="modal-announcement-title" class="fw-bold"></h4>
                <p id="modal-announcement-message"></p>
                <div id="modal-announcement-dates" class="text-muted"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // JavaScript to populate modal with the corresponding announcement details
    const announcementModal = document.getElementById('announcementModal');
    announcementModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const announcementTitle = button.getAttribute('data-title');
        const announcementMessage = button.getAttribute('data-message');
        const startDate = button.getAttribute('data-start-date');
        const endDate = button.getAttribute('data-end-date');

        // Update modal's content
        document.getElementById('modal-announcement-title').innerText = announcementTitle;
        document.getElementById('modal-announcement-message').innerText = announcementMessage;
        document.getElementById('modal-announcement-dates').innerText = 'Valid: ' + startDate + ' to ' + endDate;
    });
</script>
@endsection
