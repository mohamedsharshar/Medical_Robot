<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,doctor,nurse',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function editProfile()
    {
        return view('auth.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ];
        $messages = [];
        $request->validate($rules, $messages);
        $data = [];
        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }
        if ($request->filled('email')) {
            $data['email'] = $request->email;
        }
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        if (!empty($data)) {
            User::where('id', $user->id)->update($data);
        }
        return redirect()->route('profile.edit')->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function updateProfileImage(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'profile_image.required' => 'يجب اختيار صورة.',
            'profile_image.image' => 'الملف المرفوع يجب أن يكون صورة.',
            'profile_image.mimes' => 'الصورة يجب أن تكون بصيغة: jpeg, png, jpg, gif.',
            'profile_image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجا.'
        ]);
        $image = $request->file('profile_image');
        $imageName = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('uploads'), $imageName);
        User::where('id', $user->id)->update(['profile_image' => $imageName]);
        session(['just_uploaded_image' => $imageName]);
        return redirect()->route('profile')->with('success', 'تم رفع الصورة بنجاح');
    }
}
