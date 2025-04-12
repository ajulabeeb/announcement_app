<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Services\AnnouncementService;
use App\Http\Requests\StoreAnnouncementRequest;

class AnnouncementController extends Controller
{

    protected $announcementService;


    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;
    }

    public function index()
    {
        $announcements = $this->announcementService->listAnnouncement();
        return view('anouncements.index', compact('announcements'));
    }

    public function store(StoreAnnouncementRequest $request)
    {
        $incomingStoreRequest = $request->validated();
        $this->announcementService->addAnnouncement($incomingStoreRequest);
        // Announcement::create($incomingStoreRequest);
        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
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
        $this->announcementService->removeAnnouncement($announcement);
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
