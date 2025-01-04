<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('anouncements.index', compact('announcements'));
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Announcement::create($request->all());
        return redirect()->route('announcements.index');
    }

    public function active()
{
    $today = now()->toDateString();
    $activeAnnouncements = Announcement::where('start_date', '<=', $today)
                                       ->where('end_date', '>=', $today)
                                       ->get();
    return view('anouncements.active', compact('activeAnnouncements'));
}



    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index');
    }
}
