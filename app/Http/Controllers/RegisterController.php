<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function sendVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'full_name' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'   => $validator->errors(),
            ], 422)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        $email = $request->input('email');
        $fullName = $request->input('full_name');

        $existing = VerificationCode::where('email', $email)->first();
        if ($existing) {
            $elapsed = now()->diffInSeconds($existing->updated_at, false);
            if ($elapsed < 0) { $elapsed = 0; }
            if ($elapsed < 60) {
                $retry = 60 - $elapsed;
                return response()->json([
                    'success' => false,
                    'message' => 'Ban co the gui lai ma sau ' . $retry . ' giay.',
                    'retry_after' => $retry,
                ], 429)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
            }
        }

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        if ($existing) {
            $existing->update([
                'code' => $code,
                'expires_at' => now()->addMinutes(10),
                'verified_at' => null,
                'attempts' => 0,
            ]);
        } else {
            VerificationCode::create([
                'email' => $email,
                'code' => $code,
                'expires_at' => now()->addMinutes(10),
            ]);
        }

        try {
            Mail::to($email)->send(new VerificationCodeMail($code, $fullName, $email));
        } catch (\Exception $e) {
            \Log::error('Mail sending error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Loi gui email. Vui long thu lai.',
            ], 500)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        return response()->json([
            'success' => true,
            'message' => 'Ma xac thuc da duoc gui.',
            'cooldown' => 60,
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
    }

    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'   => $validator->errors(),
            ], 422)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        $email = $request->input('email');
        $code = $request->input('code');
        $verification = VerificationCode::where('email', $email)->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Khong tim thay ma xac thuc. Vui long gui ma moi.',
            ], 404)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        if ($verification->isExpired()) {
            return response()->json([
                'success' => false,
                'message' => 'Ma xac thuc da het han. Vui long gui ma moi.',
            ], 422)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        if ($verification->hasTooManyAttempts()) {
            return response()->json([
                'success' => false,
                'message' => 'Nhap sai qua nhieu lan. Vui long gui ma moi.',
            ], 422)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        if ($verification->code !== $code) {
            $verification->incrementAttempts();
            return response()->json([
                'success' => false,
                'message' => 'Ma xac thuc khong chinh xac. Vui long thu lai.',
            ], 422)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        $verification->markAsVerified();

        return response()->json([
            'success' => true,
            'message' => 'Ma xac thuc hop le. Vui long hoan thanh dang ky.',
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'full_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'verification_code' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'   => $validator->errors(),
            ], 422)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        $validated = $validator->validated();
        $verification = VerificationCode::where('email', $validated['email'])->first();

        if (!$verification || !$verification->isVerified()) {
            return response()->json([
                'success' => false,
                'message' => 'Email chua duoc xac thuc. Vui long xac thuc email truoc.',
            ], 422)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        if ($verification->code !== $validated['verification_code']) {
            return response()->json([
                'success' => false,
                'message' => 'Ma xac thuc khong chinh xac.',
            ], 422)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        }

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role_id' => 2,
        ]);

        $verification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dang ky thanh cong! Vui long dang nhap.',
            'redirect' => route('login'),
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
    }
}




