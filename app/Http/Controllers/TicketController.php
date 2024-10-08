<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $user = Auth::user();
    $query = Ticket::with(['event']);

    // Menambahkan kondisi berdasarkan role pengguna
    if (!$user->hasRole('admin')) {
        $query->whereHas('event', function ($q) use ($user) {
            $q->where('organizer_id', $user->id);
        });
    }

    // Menambahkan logika pencarian
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('type', 'like', '%' . $search . '%')
              ->orWhere('price', 'like', '%' . $search . '%')
              ->orWhereHas('event', function ($eventQuery) use ($search) {
                  $eventQuery->where('name', 'like', '%' . $search . '%');
              });
        });
    }

    // Mengambil hasil pencarian dan mengurutkan tiket berdasarkan id
    $tickets = $query->orderByDesc('id')->paginate(10)->withQueryString();

    return view('admin.ticket.index', compact('tickets'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $events = Event::where('organizer_id', $user->id)->orderByDesc('id')->get();
        return view('admin.ticket.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            Ticket::create($validated);
        });

        return redirect()->route('admin.ticket.index')->with('message', 'Ticket ticket Has Been Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreTicketRequest $ticket)
    {
        $user = Auth::user();

        // Memeriksa apakah pengguna yang sedang login adalah organizer dari ticket tersebut
        if ($ticket->event->organizer_id !== $user->id) {
            return back()->withErrors('Invalid role');
        }

        $events = Event::where('organizer_id', $user->id)->orderByDesc('id')->get();

        return view('admin.ticket.edit', compact('ticket', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Memeriksa apakah pengguna yang sedang login adalah organizer dari ticket tersebut
        if ($ticket->event->organizer_id !== Auth::user()->id) {
            return back()->withErrors('Invalid role');
        }

        $validated = $request->validated();

        DB::transaction(function () use ($validated, $ticket) {
            $ticket->update($validated);
        });

        return redirect()->route('admin.ticket.index')->with('message', 'Edit ticket Has Been Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        DB::beginTransaction();
        try {
            // Memeriksa apakah pengguna yang sedang login adalah organizer dari ticket tersebut
            if ($ticket->event->organizer_id !== Auth::user()->id) {
                return back()->withErrors('Invalid role');
            }

            // Menghapus ticket
            $ticket->delete();

            // Commit transaksi
            DB::commit();

            return redirect()->route('admin.ticket.index')->with('message', 'Delete ticket Has Been Success');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            return back()->withErrors('Failed to delete ticket: ' . $e->getMessage());
        }
    }
}
