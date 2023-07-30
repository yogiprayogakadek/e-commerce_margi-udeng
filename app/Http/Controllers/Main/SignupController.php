<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function signup(AuthRequest $request)
    {
        try {
            $user = [
                // 'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'role' => 'customer',
            ];

            if ($request->hasFile('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $filenamestore = str_replace(' ', '', $request->nama) . '.' . $extension;
                $save_path = 'assets/uploads/users/distributor';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }

                $request->file('foto')->move($save_path, $filenamestore);

                $user['foto'] = $save_path . '/' . $filenamestore;
            }

            $users = User::create($user);

            if($users) {
                $customer = [
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'telp' => $request->telp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'user_id' => $users->id
                ];

                Customer::create($customer);
            }

            return redirect()->route('login')->with([
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Berhasil daftar, silahkan login untuk melanjutkan'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'title' => 'Gagal',
                'message' => $e->getMessage()
                // 'message' => 'Terjadi kesalahan mohon coba lagi'
            ]);
        }
    }
}
