<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Registration::with(['participant','event','ticket']);

        // Tambahkan pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('payment_status', 'like', '%' . $search . '%')
                    ->orWhereHas('participant', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filtering berdasarkan role pengguna
        if ($user->hasRole('organizer')) {
            $query->whereHas('event', function ($subQuery) use ($user) {
                $subQuery->where('organizer_id', $user->id);
            });
        }

        $registrations = $query->orderByDesc('id')->paginate(10)->withQueryString();

        return view('admin.registration.index', compact('registrations'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration)
    {
        $registration->with('payment');
        return view('admin.registration.show', compact('registration'));
    }


    public function approve($id)
    {
        $registration = Registration::findOrFail($id);

        // Mengurangi available quantity pada ticket terkait
        $ticket = $registration->ticket;
        if ($ticket->available_quantity > 0) {
            $ticket->available_quantity -= 1;
            $ticket->save();
        } else {
            return redirect()->route('admin.registration.show', $id)->withErrors('Ticket is sold out.');
        }

        // Logika untuk menyetujui pendaftaran
        $registration->payment_status = 'paid';
        $registration->save();

        return redirect()->route('admin.registration.show', $id)->with('message', 'Registration approved successfully.');
    }

    public function reject($id)
    {
        $registration = Registration::findOrFail($id);
        // Logika untuk menolak pendaftaran
        $registration->payment_status = 'failed';
        $registration->save();

        return redirect()->route('admin.registration.show', $id)->with('message', 'Registration rejected successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
