@extends('layouts.app')

@section('PageTitle', 'Announcements')

@section('container')
    <div class="container my-5">

        <!-- All Announcements Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-4">All Announcements</h1>
                <div class="list-group">
                    @foreach ($announcements as $announcement)
                    <div class="list-group-item p-4 mb-3 shadow-sm border rounded">
                        <div class="d-flex justify-content-between">
                            <h4 class="fw-bold">{{ $announcement->title }}</h4>
                            <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                        <p class="mt-3">{{ $announcement->message }}</p>
                        <div class="mt-3 text-muted">
                            <small>Valid: {{ $announcement->start_date }} to {{ $announcement->end_date }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- View Active Announcements Section -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('announcements.active') }}" class="btn btn-secondary btn-lg w-100">View Active Announcements</a>
            </div>
        </div>

        <!-- Add New Announcement Section -->
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Add a New Announcement</h2>
                <form action="{{ route('announcements.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="title" placeholder="Title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" placeholder="Message" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Add Announcement</button>
                </form>
            </div>
        </div>

    </div>
@endsection
