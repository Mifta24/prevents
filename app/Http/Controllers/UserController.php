<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::role('participant');

        // Menambahkan logika pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('occupation', 'like', '%' . $search . '%');
            });
        }

        // Mengambil hasil pencarian dan mengurutkan organizer berdasarkan id
        $users = $query->orderByDesc('id')->paginate()->withQueryString();

        return view('admin.user.index', compact('users'));
    }


    public function destroy(User $user)
    {

        DB::transaction(function () use ($user) {

            $user->delete();
        });

        return redirect()->route('admin.user.index')->with('Delete Users has been success');
    }


    public function organizerIndex(Request $request)
    {
        $query = User::role('organizer');

        // Menambahkan logika pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('occupation', 'like', '%' . $search . '%');
            });
        }

        // Mengambil hasil pencarian dan mengurutkan organizer berdasarkan id
        $organizers = $query->orderByDesc('id')->paginate()->withQueryString();

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

    public function organizerDestroy(User $user, Request $request)
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
