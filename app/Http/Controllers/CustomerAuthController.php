<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Notifications\InviteCodeNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Services\DialogSMSService;


class CustomerAuthController extends Controller
{
    // Show Registration Page
    public function showRegister(Request $request)
    {
        $refCode = $request->query('ref');
        return view('frontend.signup', compact('refCode'));
    }

    // Handle Registration
    public function register(Request $request)
    {
        try{
        //dd($request);
        $request->validate([
            // 'name' => 'required|string',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'contact_number' => 'required|string|unique:customers,contact_number',
            'password' => 'required|min:6|confirmed',
            'sponser_code' => 'nullable|string|max:255',
        ]);
        //dd($request);

        session([
            'pending_customer' => [
                // 'name' => $request->name,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'password' => Hash::make($request->password),
                'sponser_code' => $request->sponser_code,
            ]
        ]);

            // Get the latest customer (or whatever model you're using)
            $latestCustomer = Customer::orderBy('user_id', 'desc')->first();
            $nextNumber = $latestCustomer ? $latestCustomer->user_id + 1 : 1;
            // Format as BW0001, BW0002, etc.
            $inviteCode = 'BW' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);


        $customer = Customer::create([
            'name' => $request->fname . ' ' . $request->lname,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'password' => Hash::make($request->password),
            'status' => 0, // Default status inactive
            'is_verified' => false, // Default not verified
            'is_side_selected' => false, // Default side not selected
            'invite_code' => $inviteCode,
            'sponsor_id' => $request->sponser_code ? Customer::where('invite_code', $request->sponser_code)->value('user_id') : null,
        ]);

            // Generate a simple token or signed URL for verification
            $token = sha1($customer->email . time());
            $customer->email_verification_token = $token;
            $customer->save();

            // Send Email Verification Link
            $customer->notify(new VerifyEmailNotification($token));

            // Send Invite Code to Email
            $customer->notify(new InviteCodeNotification($inviteCode));

            return redirect()->route('customer.login')->with('success', 'Registration complete. Please please comfirm your email.');


    } catch (\Throwable $e) {
        Log::error('Registration Error: ' . $e->getMessage());
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
    }

    public function verifyEmail($token)
    {
        $customer = Customer::where('email_verification_token', $token)->first();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Invalid verification token.');
        }

        $customer->is_verified = true;
        $customer->email_verification_token = null;
        $customer->email_verified_at = now(); // Set the email verified timestamp
        $customer->save();

        return redirect()->route('customer.login')->with('success', 'Email verified successfully. You can now log in.');
    }


    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        $data = session('pending_customer');

        if (!$data || $data['verification_code'] != $request->code) {
            return back()->with('error', 'Invalid or expired code.');
        }

        // 🔍 Check if it's an old student
        if (!empty($data['student_id'])) {
            $studentId = $data['student_id'];

            // ✅ Validate format DSAxxxx
            if (!preg_match('/^DSA\d{4}$/', $studentId)) {
                return back()->with('error', 'Invalid Student ID format. Must be like DSA0049.');
            }

            // ✅ Validate it's < DSA0500
            $numericPart = (int)substr($studentId, 3);
            if ($numericPart >= 500) {
                return back()->with('error', 'Old student ID must be less than DSA0500.');
            }

            $stuId = $studentId;
        } else {
            // 🆕 New student ID generation starts from 0500
            $lastId = Customer::orderByDesc('user_id')->first()?->stu_id ?? 'DSA0499';
            $lastNumber = (int)substr($lastId, 3);
            $nextNumber = max(500, $lastNumber + 1);
            $stuId = 'DSA' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        }

        // 🧾 Save customer
        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'contact_number' => $data['contact_number'],
            'email_verified_at' => now(),
            'status' => 1,
            'stu_id' => $stuId,
        ]);

        session()->forget('pending_customer');

        return redirect()->route('customer.login')->with('success', 'Registration complete. Please log in.');
    }



    public function sendSMS($mobile, $message)
    {
        try {
            $dialog = new DialogSMSService();
            $dialog->sendSMS($mobile, $message);
        } catch (\Exception $e) {
            Log::error("Dialog SMS Error: " . $e->getMessage());
            throw new \Exception("SMS sending failed.");
        }
    }

    public function showCodeForm()
    {
        return view('emails.verify-code-page');
    }


    // Show Login Page
    public function showLogin()
    {
        return view('frontend.login');
    }

    // Handle Login
    public function login(Request $request)
    {

        $request->validate([
            'invite_code' => 'required|exists:customers,invite_code',
            'password' => 'required',
        ]);
        //dd($request);

        $customer = Customer::where('invite_code', $request->invite_code)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            // Custom session
            session([
                'customer_id' => $customer->user_id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'contact_number' => $customer->contact_number,
            ]);
            return redirect()->route('frontend.home')->with('success', 'Login successful!');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials.');
        }
    }

    // Logout
    public function logout()
    {
        Session::forget(['customer_id', 'customer_name']);
        return redirect()->route('customer.login')->with('success', 'Logged out successfully.');
    }


    public function showOldRegisterForm()
    {
        return view('frontend.old-register');
    }

    public function submitOldRegister(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'contact_number' => 'required|string|unique:customers,contact_number|max:20',
            'student_id' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $code = rand(100000, 999999);

        session([
            'pending_customer' => [
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'password' => Hash::make($request->password),
                'verification_code' => $code,
                'student_id' => $request->student_id,
            ]
        ]);

        return redirect()->route('customer.verify.code.form')->with('success', 'Verification code sent.');
    }


}
