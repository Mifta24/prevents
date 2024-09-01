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
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('organizer')) {

            $registrations = Registration::whereHas('event', function ($query) use ($user) {
                $query->where('organizer_id', $user->id);
            })->orderByDesc('id')->get();
        } else {

            $registrations = Registration::orderByDesc('id')->get();
        }

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
