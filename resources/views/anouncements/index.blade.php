@extends('layouts.app')
@section('PageTitle','Annouce App')
@section('container')
    <div class="mb-4">

        <div class="row">

            <h1>All Announcements</h1>
            <ul class="list-group">
                @foreach ($announcements as $announcement)
                <li class="list-group-item">
                    <strong>{{ $announcement->title }}</strong>
                    <p>{{ $announcement->message }}</p>
                    <p>Valid: {{ $announcement->start_date }} to {{ $announcement->end_date }}</p>
                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="row mb-4 col-2">
            <a href="{{ route('announcements.active') }}" class="btn btn-secondary">View Active Announcements</a>
        </div>
        <div class="row">

            <h2>Add a New Announcement</h2>

            <form action="{{ route('announcements.store') }}" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Title" class="form-control" required>
                <textarea name="message" placeholder="Message" class="form-control" required></textarea>
                <input type="date" name="start_date" class="form-control" required>
                <input type="date" name="end_date" class="form-control" required>
                <button type="submit" class="btn btn-primary">Add Announcement</button>
            </form>
        </div>
    </div>
    </div>


@endsection
