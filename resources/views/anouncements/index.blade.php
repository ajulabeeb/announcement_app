@extends('layouts.app')
@section('PageTitle','Annouce App')
@section('container')

    <h1>All Announcements</h1>
    <ul>
        @foreach ($announcements as $announcement)
            <li>
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

    <h2>Add a New Announcement</h2>
    <form action="{{ route('announcements.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button type="submit">Add Announcement</button>
    </form>

    <a href="{{ route('announcements.active') }}">View Active Announcements</a>


@endsection
