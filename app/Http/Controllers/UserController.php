<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function organizerIndex()
    {
        $organizers = User::role('organizer')->orderByDesc('id')->get();
        return view('admin.organizer.index', compact('organizers'));
    }

    public function organizerCreate()
    {
        return view('admin.organizer.create');
    }

    public function organizerStore(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        if ($user->hasRole('organizer')) {
            return back()->withErrors(['email' => 'Email sudah terdaftar sebagai organizer']);
        }


        DB::transaction(function () use ($user) {

            if ($user->hasRole('participant')) {
                $user->removeRole('participant');
            }
            $user->assignRole('organizer');
        });

        return redirect()->route('admin.organizer.index');
    }

    public function organizerDestroy(User $user,Request $request)
    {

        DB::transaction(function () use ($user) {

            if ($user->hasRole('organizer')) {
                $user->removeRole('organizer');
            }
            $user->assignRole('participant');
        });

        return redirect()->route('admin.organizer.index')->with('Delete Organizer has been success');
    }
}
