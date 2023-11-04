<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:events.index|events.create|events.edit|events.delete');
    }

    public function index()
    {
        $events = Event::latest()->when(request()->q, function ($events) {
            $events = $events->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.event.index', compact('events'));
    }
    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'location' => 'required',
            'date' => 'required',
            'content' => 'required'
        ]);

        $event = Event::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'), '-'),
            'location' => $request->input('location'),
            'date' => $request->input('date'),
            'content' => $request->input('content'),
        ]);

        if ($event) {
            return redirect()->route('admin.event.index')->with(['success' => 'Saved Data Successfully!']);
        } else {
            return redirect()->route('admin.event.index')->with(['error' => 'Saved Data Failed!']);
        }
    }
    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'title' => 'required',
            'location' => 'required',
            'date' => 'required',
            'content' => 'required',
        ]);

        $event = Event::findOrFail($event->id);
        $event->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'), '-'),
            'location' => $request->input('location'),
            'date' => $request->input('date'),
            'content' => $request->input('content'),
        ]);

        if ($event) {
            return redirect()->route('admin.event.index')->with(['success' => 'Update Data Successfully!']);
        } else {
            return redirect()->route('admin.event.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        if ($event) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
