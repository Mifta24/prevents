<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function organizer(Request $request)
    {
        $user = User::where('email', $request->email);

        if ($user->hasRole('participant')) {
            $user->removeRole('participant');
        }
        $user->assignRole('organizer');

        return redirect()->route('admin.organizer.index');
    }
}
