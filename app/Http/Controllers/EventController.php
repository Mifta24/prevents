<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderByDesc('id')->paginate(10);
        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $user = Auth::user();

        if (!$user) {
            return back()->withErrors('Invalid role');
        }

        $validated = $request->validated();
        $validated['slug'] = Str::slug($request->name);
        $validated['organizer_id'] = $user->id;

        DB::transaction(function () use ($validated) {
            Event::create($validated);
        });

        return redirect()->route('admin.event.index')->with('message', 'Create Event Has Been Success');
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {

        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEventRequest $request, Event $event)
    {
         // Memeriksa apakah pengguna yang sedang login adalah organizer dari event tersebut
         if ($event->organizer_id !== Auth::user()->id) {
            return back()->withErrors('Invalid role');
        }

        $validated = $request->validated();

        DB::transaction(function () use ($validated, $event) {
            $event->update($validated);
        });

        return redirect()->route('admin.event.index')->with('message', 'Edit Event Has Been Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        DB::beginTransaction();
        try {
            // Memeriksa apakah pengguna yang sedang login adalah organizer dari event tersebut
            if ($event->organizer_id !== Auth::user()->id) {
                return back()->withErrors('Invalid role');
            }

            // Menghapus event
            $event->delete();

            // Commit transaksi
            DB::commit();

            return redirect()->route('admin.event.index')->with('message', 'Delete Event Has Been Success');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return back()->withErrors('Failed to delete event: ' . $e->getMessage());
        }
    }
}
