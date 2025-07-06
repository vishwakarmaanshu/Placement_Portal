<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('role', 'user')->get();
        return view('ad.dashboard', compact('users'));
        
    }


public function users()
{
    $users = User::all();
    return view('admin.users', compact('users'));
}

}
