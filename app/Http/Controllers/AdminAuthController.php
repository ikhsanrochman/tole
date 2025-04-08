<?php
// File: app/Http/Controllers/AdminAuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    
    /**
     * Handle admin login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // The password in the database is stored as an MD5 hash
        // We'll need to modify the authentication to check against MD5
        $admin = \App\Models\Admin::where('email', $credentials['email'])->first();
        
        if ($admin && md5($credentials['password']) === $admin->password) {
            // Login the admin manually
            Auth::guard('admin')->login($admin);
            return redirect()->intended(route('admin.dashboard'));
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }
    
    /**
     * Handle admin logout request
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
}

// File: app/Http/Controllers/AdminDashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $propertyCount = Rumah::count();
        $availableCount = Rumah::where('status', 'Available')->count();
        $soldCount = Rumah::where('status', 'Sold')->count();
        
        return view('admin.dashboard', compact('propertyCount', 'availableCount', 'soldCount'));
    }
    
    /**
     * Show properties list
     */
    public function properties()
    {
        $properties = Rumah::all();
        return view('admin.properties', compact('properties'));
    }
    public function editProfile()
{
    $admin = Auth::guard('admin')->user();
    return view('admin.profile.edit', compact('admin'));
}

public function updateProfile(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $rules = [
        'email' => 'required|email|max:255|unique:admin,email,' . $admin->id,
        'whatsapp' => 'required|string|max:20',
    ];

    if ($request->filled('password')) {
        $rules['password'] = 'min:6';
    }

    $validated = $request->validate($rules);

    $admin->email = $validated['email'];
    $admin->whatsapp = $validated['whatsapp'];

    if (!empty($validated['password'])) {
        $admin->password = md5($validated['password']); // Sesuai dengan sistem login kamu
    }

    $admin->save();

    return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui!');
}
}