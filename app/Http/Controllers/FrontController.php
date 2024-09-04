<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\StoreRegistration;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $events =Event::with('tickets')->orderBYDesc('id')->get();
        return view('front.index', compact('events'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function event()
    {
        $events = Event::with('tickets')->orderBYDesc('id')->get();
        return view('front.event.index', compact('events'));
    }

    public function detailEvent(Event $event)
    {
        $event->load('tickets');
        return view('front.event.detail', compact('event'));
    }


    public function ticket()
    {
        $tickets = Ticket::with('event')->orderByDesc('id')->get();
        return view('front.ticket', compact('tickets'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function myTickets()
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Mengambil semua registrasi yang terkait dengan user tersebut
        $registrations = Registration::where('participant_id', $userId)->with(['event', 'ticket'])->get();

        // Mengirim data registrasi ke view
        return view('front.profile.ticket', compact('registrations'));
    }


    public function myTransactions()
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Mengambil semua pembayaran yang terkait dengan user tersebut
        $transactions = Payment::with(['registration'])->whereHas('registration', function ($query) use ($userId) {
            $query->where('participant_id', $userId);
        })->with(['registration.event'])->get();

        // Mengirim data transaksi ke view
        return view('front.profile.transaction', compact('transactions'));
    }

    public function myReceipts()
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();


        // Mengambil semua pembayaran yang terkait dengan user tersebut
        $receipts = Payment::with(['registration'])->whereHas('registration', function ($query) use ($userId) {
            $query->where('participant_id', $userId);
        })->with(['registration.event'])->get();


        if ($userId != $receipts->registration->participant_id) {
            return back()->withErrors('Invalid access user');
        }

        // Mengirim data receipt ke view
        return view('front.profile.receipt', compact('receipts'));
    }


    public function registration(Event $event)
    {

        return view('front.registration.index', compact('event'));
    }
    public function registrationStore(Event $event, StoreRegistration $request)
    {

        $user = User::where('id', Auth::user()->id)->first();

        if ($user->email != $request->email) {
            return back()->withErrors(['email' => 'Email not match']);
        }

        $validated = $request->validated();

        $validated['event_id'] = $event->id;
        $validated['participant_id'] = $user->id;
        $validated['payment_status'] = 'pending';

        // Mengembalikan objek $registration dari transaksi
        $registration = DB::transaction(function () use ($validated) {
            return Registration::create($validated);
        });

        return redirect()->route('payment', $registration->id);
    }

    public function payment($idReg)
    {
        $registration = Registration::with(['event','ticket'])->where('id', $idReg)->first();
        return view('front.payment.index', compact('registration'));
    }

    public function paymentStore(StorePaymentRequest $request, $idReg)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa jika user memiliki role 'participant', jika ya maka tolak akses
        if (!$user->hasRole('participant')) {
            return back()->withErrors(['error' => 'Invalid role']);
        }

        // Temukan pendaftaran (registration) berdasarkan ID
        $registration = Registration::find($idReg);

        // Periksa jika registration tidak ditemukan
        if (!$registration) {
            return back()->withErrors(['error' => 'Registration not found']);
        }

        // Validasi request
        $validated = $request->validated();

        // Persiapkan data untuk pembayaran
        $validated['registration_id'] = $registration->id;
        $validated['amount'] = $registration->ticket->price;
        $validated['payment_date'] = Carbon::now();
        $validated['status'] = 'success';

        // Lakukan transaksi database
        DB::transaction(function () use ($validated) {
            Payment::create($validated);
        });

        // Redirect ke halaman receipt dengan pesan sukses
        return redirect()->route('receipt', $validated['registration_id'])->with('message', 'Pembayaran Success');
    }


    public function receipt($idReg)
    {
        // Menggunakan first() untuk mendapatkan satu instance dari model Registration
        $transaction = Registration::with(['event','ticket','payment'])->where('id', $idReg)->first();

        // Pastikan bahwa $transaction adalah instance yang valid sebelum mengakses properti
        if (!$transaction) {
            return redirect()->route('index')->withErrors('Transaction not found.');
        }

        // Mengakses properti dari instance model Registration
        $event = $transaction->event;
        $user = $transaction->participant;
        $payment = $transaction->payment;

        // Pastikan pengguna yang sedang login adalah pemilik transaksi
        if (Auth::user()->id != $user->id) {
            abort(404); // Kirim abort ke 404 jika akses tidak valid
        }

        // Mengirimkan data ke view
        return view('front.receipt.index', compact('transaction', 'event', 'user', 'payment'));
    }
}
