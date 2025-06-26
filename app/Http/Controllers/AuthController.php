<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'username' => 'required|email',
                'password' => 'required|min:6',
            ], [
                'username.required' => 'Email harus diisi',
                'username.email' => 'Format email tidak valid',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 6 karakter',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Kirim request ke NeoFeeder API
            $response = Http::post('https://neofeeder.serveruis.my.id/ws/live2.php', [
                'act' => 'GetToken',
                'username' => $request->username,
                'password' => $request->password,
            ]);

            if (!$response->ok() || !isset($response['data']['token'])) {
                return back()->withErrors(['login' => 'Login gagal dari server feeder']);
            }

            $token = $response['data']['token'];
            $username = $request->username;

            // Cek user di database
            $user = User::where('email', $username)->first();

            if (!$user) {
                // Simpan user baru jika belum ada
                $user = User::create([
                    'name' => 'User Feeder', // Ganti jika ada data nama
                    'email' => $username,
                    'password' => bcrypt($request->password),
                    'feeder_token' => $token,
                ]);
            } else {
                // Update token jika user sudah ada
                $user->update([
                    'feeder_token' => $token
                ]);
            }

            // Login manual
            Auth::login($user);

            // Simpan token juga ke session kalau perlu
            Session::put('feeder_token', $token);
            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
    public function logout(Request $request)
    {
        // Hapus session dan feeder token
        Session::forget('feeder_token');

        // Logout Laravel user
        Auth::logout();

        // Optional: flush all session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Berhasil logout');
    }
}
