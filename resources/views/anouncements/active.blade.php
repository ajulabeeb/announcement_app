@extends('layouts.app')
@section('PageTitle','Active')
@section('container')

    <h1>Active Announcements</h1>
    <ul class="list-group">
        @foreach ($activeAnnouncements as $announcement)
            <li class="list-group-item">
                <strong>{{ $announcement->title }}</strong>
                <p>{{ $announcement->message }}</p>
                <p>Valid: {{ $announcement->start_date }} to {{ $announcement->end_date }}</p>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('announcements.index') }}">Back to All Announcements</a>
@endsection
