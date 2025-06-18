<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::where('role','admin')->get();
        return view('admin.user', compact('admin'));
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        try {
            // Validasi input pengguna
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin',
            ]);

            // Jika validasi gagal, kembalikan respon dengan pesan error dan informasi yang kurang
            if ($validator->fails()) {
                $errors = $validator->errors();
                $errorMessage = '';

                if ($errors->has('username')) {
                    $errorMessage .= 'Username is required. ';
                }

                if ($errors->has('email')) {
                    $errorMessage .= 'Email is required. ';
                }

                if ($errors->has('password')) {
                    $errorMessage .= 'Password is required and must be at least 8 characters. ';
                }

                // Tampilkan notifikasi Swal.fire dengan pesan error dan informasi yang kurang
                $notification = [
                    'title' => 'Oops!',
                    'text' => $errorMessage,
                    'type' => 'error',
                ];

                return redirect()->back()->with('notification', $notification)->withInput();
            }

            // Buat data pengguna baru
            $admin = new User();
            $admin->username = $request->input('username');
            $admin->email = $request->input('email');
            $admin->password = bcrypt($request->input('password'));
            $admin->save();

            // Tampilkan notifikasi Swal.fire
            $notification = [
                'title' => 'Selamat!',
                'text' => 'Data pengguna berhasil ditambahkan',
                'type' => 'success',
            ];

            return redirect()->route('user.index')->with('notification', $notification);
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error($e->getMessage());

            // Tampilkan notifikasi Swal.fire
            $notification = [
                'title' => 'Oops!',
                'text' => 'Terjadi kesalahan saat menambahkan data pengguna',
                'type' => 'error',
            ];

            return redirect()->back()->with('notification', $notification)->withInput();
        }
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi input pengguna
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Simpan admin baru
            $admin = new User();
            $admin->username = $request->input('username');
            $admin->email = $request->input('email');
            $admin->password = bcrypt($request->input('password'));
            $admin->save();

            return redirect()->route('user.index')->with('success', 'Admin berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function updateProfile(Request $request)
    {
        try {
            // Validasi input pengguna
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . auth()->id(),
                'password' => 'nullable|string|min:8',
            ]);

            // Jika validasi gagal, kembalikan respon dengan pesan error
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                // Tampilkan notifikasi Swal.fire dengan pesan validasi
                $notification = [
                    'title' => 'Oops!',
                    'text' => 'Terjadi kesalahan saat memperbarui data pengguna',
                    'type' => 'error',
                    'validation' => $errors,
                ];

                return redirect()->back()->with('notification', $notification)->withInput();
            }

            // Temukan pengguna yang sedang login
            $admin = auth()->user();

            // Update data pengguna
            $admin->username = $request->input('username');
            $admin->email = $request->input('email');

            // Periksa apakah ada input password baru
            if ($request->filled('password')) {
                $admin->password = bcrypt($request->input('password'));
            }

            $admin->save();

            return redirect()->route('dashboard.index')->with('success', 'Data pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Tambahkan ini untuk mencetak pesan error

            // Tampilkan notifikasi Swal.fire dengan pesan error umum
            $notification = [
                'title' => 'Oops!',
                'text' => 'Terjadi kesalahan saat memperbarui data pengguna',
                'type' => 'error',
            ];

            return redirect()->back()->with('notification', $notification)->withInput();
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        try {
            // Validasi input pengguna
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
            ]);

            // Jika validasi gagal, kembalikan respon dengan pesan error
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                // Tampilkan notifikasi Swal.fire dengan pesan validasi
                $notification = [
                    'title' => 'Oops!',
                    'text' => 'Terjadi kesalahan saat memperbarui data pengguna',
                    'type' => 'error',
                    'validation' => $errors,
                ];

                return redirect()->back()->with('notification', $notification)->withInput();
            }

            // Temukan pengguna berdasarkan ID
            $admin = User::findOrFail($id);

            // Update data pengguna
            $admin->username = $request->input('username');
            $admin->email = $request->input('email');

            // Periksa apakah ada input password baru
            if ($request->filled('password')) {
                $admin->password = bcrypt($request->input('password'));
            }

            $admin->save();

            return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error($e);

            // Tampilkan notifikasi Swal.fire dengan pesan error umum
            $notification = [
                'title' => 'Oops!',
                'text' => 'Terjadi kesalahan saat memperbarui data pengguna',
                'type' => 'error',
            ];

            return redirect()->back()->with('notification', $notification)->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();

        $notification = [
            'title' => 'Selamat!',
            'text' => 'Data pengguna berhasil dihapus',
            'type' => 'success',
        ];

        return redirect()->route('user.index')->with('notification', $notification)->withInput();
    }

}