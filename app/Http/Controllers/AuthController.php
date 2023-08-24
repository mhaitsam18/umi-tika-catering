<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('home');
        } else if(auth()->user()->role == "admin") {
            return redirect('/admin/index');
        } else if(auth()->user()->role == "member"){
            return redirect('/member/index');
        } else{
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/');
        }
    }

    public function login()
    {
        return view('auth.login', [
            'title' => 'Umi Tika Catering | login'
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Umi Tika Catering | Registrasi'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'image' => 'image|file',
            'password' => 'required|confirmed',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'member';

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('foto-profil');
        };

        $user = User::create($validatedData);

        $validatedMember['user_id'] = $user->id;

        Member::create($validatedMember);

        return redirect('/login')->with('success', 'Registrasi Berhasil!');
    }


    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            switch (auth()->user()->role) {
                case 'admin':
                    return redirect()->intended('/admin/index');
                    break;
                case 'member':
                    $member = Member::where('user_id', auth()->user()->id)->first();
                    $request->session()->put('member', $member);
                    $request->session()->put('member_id', $member->id);
                    return redirect()->intended('/member/index');
                    break;
                default:
                    return back()->with('loginError', 'Akun Anda tidak memiliki otoritas apapun, Hubungi Admin terkait');
                    # code...
                    break;
            }
        }

        return back()->with('loginError', 'Username atau Password Salah');
    }

    public function updatePhoto(Request $request, User $user)
    {
        $user->update([
            'image' => $request->nama_foto
        ]);
        return back()->with('success', 'Foto Berhasil diperbarui');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
