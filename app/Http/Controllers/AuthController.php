<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    // Login with either username or email in one field
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $login = $credentials['login'];
        $query = User::query();
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $query->where('email', $login);
        } else {
            $query->where('username', $login);
        }
        $user = $query->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['login' => 'Thông tin đăng nhập không đúng.'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();
        session(['EmployeeName' => $user->full_name ?? $user->username]);

        $redirectRoute = $user->role_id == 1 ? 'admin.dashboard' : 'home';
        return redirect()->route($redirectRoute);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Đăng xuất thành công.');
    }

    // Account page
    public function account(Request $request)
    {
        $user = Auth::user();

        $wishlistItems = Wishlist::where('user_id', $user->user_id)
            ->with('product')
            ->get()
            ->map(function ($wishlist) {
                return $wishlist->product;
            });

        $shippingAddress = DB::table('shipping_address')
            ->where('user_id', $user->user_id)
            ->first();

        return view('account', [
            'wishlistItems' => $wishlistItems,
            'currentOrders' => [],
            'orderHistory' => [],
            'shippingAddress' => $shippingAddress,
        ]);
    }

    // Update account
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'full_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'gender' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address_detail' => ['nullable', 'string', 'max:500'],
            'district' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if (!empty($data['full_name'])) {
            $user->full_name = $data['full_name'];
        }
        if (!empty($data['email'])) {
            $user->email = $data['email'];
        }
        if (array_key_exists('gender', $data) && $data['gender'] !== null) {
            $user->gender = $data['gender'];
        }
        if (array_key_exists('phone', $data) && $data['phone'] !== null) {
            $user->phone = $data['phone'];
        }
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        if (
            array_key_exists('address_detail', $data) ||
            array_key_exists('district', $data) ||
            array_key_exists('province', $data)
        ) {
            $addressData = [];
            if (array_key_exists('address_detail', $data) && $data['address_detail'] !== null) {
                $addressData['address_detail'] = $data['address_detail'];
            }
            if (array_key_exists('district', $data) && $data['district'] !== null) {
                $addressData['district'] = $data['district'];
            }
            if (array_key_exists('province', $data) && $data['province'] !== null) {
                $addressData['province'] = $data['province'];
            }

            if (!empty($addressData)) {
                $existing = DB::table('shipping_address')
                    ->where('user_id', $user->user_id)
                    ->first();

                if ($existing) {
                    DB::table('shipping_address')
                        ->where('address_id', $existing->address_id)
                        ->update($addressData);
                } else {
                    $addressData['user_id'] = $user->user_id;
                    DB::table('shipping_address')->insert($addressData);
                }
            }
        }

        return redirect()->route('account')->with('success', true);
    }
}

