<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Placement;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class PlacementController extends Controller
{
    // Show all placements
    public function index()
    {
        $placements = Placement::with(['user', 'course'])->get();
    return view('admin.placements.index', compact('placements'));
    }

    

    // Show create form
   public function create()
{
    $users = User::all(); // ✅ add this line
    $courses = Course::all();
    return view('admin.placements.create', compact('users', 'courses'));
}

    // Store placement
   public function store(Request $request)
{
    $data = $request->validate([
        'user_identifier' => 'required',
        'course_id' => 'required|exists:courses,id',
        'company' => 'required',
        'photo' => 'nullable|image|max:2048',
    ]);

    // Find user by first_name or email
    $user = User::where('first_name', $data['user_identifier'])
                ->orWhere('email', $data['user_identifier'])
                ->first();

    if (!$user) {
        return back()->with('error', 'Invalid user. No user found with that name or email.');
    }

    $placementData = [
        'user_id' => $user->id,
        'course_id' => $data['course_id'],
        'company' => $data['company'],
    ];

    // ✅ Only one photo upload block
    if ($request->hasFile('photo')) {
        $file     = $request->file('photo');
        $ext      = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $ext;
        $path     = $file->storeAs('photos', $filename, 'public');
        $placementData['photo'] = $path;
    }

    Placement::create($placementData);

    return redirect()->route('admin.placements.index')->with('success', 'Placement added successfully!');
}

    // Edit placement form
    public function edit($id)
    {
        $placement = Placement::findOrFail($id);
        $courses = Course::all();
        return view('admin.placements.edit', compact('placement', 'courses'));
    }

    // Update placement
    public function update(Request $request, $id)
{
    $placement = Placement::findOrFail($id);

    $data = $request->validate([
        'course_id' => 'required|exists:courses,id',
        'company' => 'required',
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $file     = $request->file('photo');
        $ext      = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $ext;
        $path     = $file->storeAs('photos', $filename, 'public');
        $data['photo'] = $path;
    }

    $placement->update($data);

    return redirect()->route('admin.placements.index')->with('success', 'Placement updated!');
}


    // Delete placement
    public function destroy($id)
    {
        $placement = Placement::findOrFail($id);
        $placement->delete();
        return redirect()->route('admin.placements.index')->with('success', 'Placement deleted!');
    }

    // Admin dashboard
    // public function adminDashboard()
    // {
    //     $placements = Placement::with(['user', 'course'])->get();
    //     return view('admin.dashboard', compact('placements'));
    // }

    // Homepage
    public function home()
    {
        $placements = Placement::latest()->take(10)->with(['user', 'course'])->get();
        return view('home', compact('placements'));
    }
    public function showLogin()
{
    return view('auth.login'); // or wherever your login blade is
}

// public function loginUser(Request $request)
// {
//     $credentials = $request->only('email', 'password');

//     if (Auth::attempt($credentials)) {
//         $request->session()->regenerate(); // 🔑 Important to prevent session fixation
//         return redirect()->intended('user/dashboard');
//     }

//     return back()->withErrors(['email' => 'Invalid credentials.']);
// }

public function loginUser(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Store user info in session
        session([
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->first_name,
            // 'user_role' => Auth::user()->role, // optional
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Logged in successfully!');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}




// public function login(Request $request)
// {
//     // Validate and attempt login
//     if (Auth::attempt($request->only('email', 'password'))) {
//         if (auth()->user()->role === 'admin') {
//             return redirect()->route('admin.dashboard');
//         } else {
//             return redirect()->route('user.dashboard');
            
//         }
//     }

//     return back()->withErrors(['Invalid credentials']);
// }



public function showRegister()
{
    return view('auth.register'); // make sure this Blade view exists
}


   public function registerUser(Request $request)
{
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'contact_no' => 'required',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'username' => $request->username,
        'email' => $request->email,
        'contact_no' => $request->contact_no,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user); // 🔐 Automatically log in the user

    // ✅ Set session variables (optional)
    session([
        'first_name' => $user->first_name,
        'user_id' => $user->id
    ]);

    return redirect()->route('auth.login'); // or any page
}
   
    
    


    public function dashboard()
{
    // $user = auth()->user();
    $userId = Auth::id(); 
    return view('user.dashboard', compact('user'));
}

public function adminDashboard()
{
    return view('admin.dashboard');// or any Blade file like admin/dashboard.blade.php
}

public function __construct()
{
    $this->middleware('auth')->except([
        'home',
        'showLogin',
        'loginUser',
        'showRegister',
        'registerUser',
    ]);
}

public function logout(Request $request)
{
    Auth::logout();

    // Optional: Clear session and regenerate token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Logged out successfully!');
}





}
