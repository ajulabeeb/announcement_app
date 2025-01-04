<?php

namespace App\Http\Controllers;

use App\Models\announcment;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcments = announcment::all();
        return view('anouncements.index', compact('announcements'));
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        announcment::create($request->all());
        return redirect()->route('anouncements.index');
    }


    public function destroy()
    {

    }
}
