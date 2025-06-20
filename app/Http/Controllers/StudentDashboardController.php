<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationCodeMail;
use App\Services\DialogSMSService;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\CourseFile;
use App\Models\CourseRecording;
use App\Models\CourseZoomLink;
use App\Models\CustomerCourseBatch;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $customerId = session('customer_id');
        if ($customerId === null) {
            return redirect()->route('customer.login')->with('error', 'Please log in to access your dashboard.');
        }
        $customer = Customer::where('user_id', $customerId)
            ->first();
        $invitees = Customer::where('sponsor_id', $customerId)
            ->where('is_side_selected', 0)
            ->where('status', 1) // Only active invitees
            ->get();
        $wallet = Wallet::with('transactions')
            ->where('customer_id', $customerId)
            ->first();
        if (!$wallet) {
            // Create a new wallet if it doesn't exist
            $wallet = Wallet::create([
                'customer_id' => $customerId,
                'balance' => 0,
                'total_deposited' => 0,
                'total_withdrawn' => 0,
                'status' => 'active', // Active
                'currency' => 'LKR', // Default currency
            ]);
        }

        return view('StudentDashboard.home', compact('invitees', 'customer', 'wallet'));
    }

    public function bookings()
    {
        $customerId = session('customer_id');

        $customer = Customer::where('user_id', $customerId)
            ->where('status', 1) // Only active customers
            ->first();

        if (!$customer) {
            // Optionally handle inactive or non-existent customer
            return redirect()->back()->with('error', 'Access denied or customer inactive.');
        }

        $bookings = $customer->bookings()
            ->with('course')
            ->whereIn('status', ['Confirmed', 'Half'])
            ->get();

        return view('StudentDashboard.course.main', compact('bookings'));
    }


    public function courseDetails($bookingId)
    {
        $customerId = session('customer_id');

        $booking = Booking::with('course')
            ->where('customer_id', $customerId)
            ->where('id', $bookingId)
            ->firstOrFail();

        return view('StudentDashboard.course.view', compact('booking'));
    }

    public function courseFiles($bookingId)
    {
        $customerId = session('customer_id');

        // Get the booking and related course
        $booking = Booking::with('course')->where('id', $bookingId)
            ->where('customer_id', $customerId)
            ->firstOrFail();

        // Get the customer's batch for that course
        $customerBatch = CustomerCourseBatch::where('customer_id', $customerId)
            ->where('course_id', $booking->course_id)
            ->first();

        if (!$customerBatch) {
            abort(403, 'You are not assigned to a batch for this course.');
        }

        // Get course files for that course and batch
        $files = DB::table('course_files as cf')
            ->join('course_file_batch as cfb', 'cf.file_id', '=', 'cfb.course_file_id')
            ->where('cf.course_id', $booking->course_id)
            ->where('cfb.batch_id', $customerBatch->batch_id)
            ->select('cf.*')
            ->get();

        return view('StudentDashboard.course.files', compact('files', 'booking'));
    }


    public function courseRecordings($bookingId)
    {
        $customerId = session('customer_id');

        // Get booking
        $booking = Booking::with('course')->where('id', $bookingId)
            ->where('customer_id', $customerId)
            ->firstOrFail();

        // Get customer's batch
        $customerBatch = CustomerCourseBatch::where('customer_id', $customerId)
            ->where('course_id', $booking->course_id)
            ->first();

        if (!$customerBatch) {
            abort(403, 'You are not assigned to a batch for this course.');
        }

        // Get course recordings filtered by course and batch
        $recordings = DB::table('course_recordings as cr')
            ->join('course_recording_batch as crb', 'cr.recording_id', '=', 'crb.course_recording_id')
            ->where('cr.course_id', $booking->course_id)
            ->where('crb.batch_id', $customerBatch->batch_id)
            ->select('cr.*')
            ->get();

        return view('StudentDashboard.course.recordings', compact('recordings', 'booking'));
    }

    public function courseZoomLinks($bookingId)
    {
        $customerId = session('customer_id');

        // Get booking
        $booking = Booking::with('course')->where('id', $bookingId)
            ->where('customer_id', $customerId)
            ->firstOrFail();

        // Get customer's batch
        $customerBatch = CustomerCourseBatch::where('customer_id', $customerId)
            ->where('course_id', $booking->course_id)
            ->first();

        if (!$customerBatch) {
            abort(403, 'You are not assigned to a batch for this course.');
        }

        // Get zoom links filtered by course and batch
        $zoomLinks = DB::table('course_zoom_links as czl')
            ->join('course_zoom_link_batch as czlb', 'czl.zoom_link_id', '=', 'czlb.course_zoom_link_id')
            ->where('czl.course_id', $booking->course_id)
            ->where('czlb.batch_id', $customerBatch->batch_id)
            ->select('czl.*')
            ->get();

        return view('StudentDashboard.course.zoom-links', compact('zoomLinks', 'booking'));
    }

    public function profile()
    {
        $customerId = session('customer_id');
        $customer = Customer::findOrFail($customerId);

        return view('StudentDashboard.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customerId = session('customer_id');
        $customer = Customer::findOrFail($customerId);

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'kyc_doc_type' => 'nullable|string|max:50',
            'kyc_doc_number' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:100',
            'bank_branch' => 'nullable|string|max:100',
            'account_name' => 'nullable|string|max:100',
            'account_number' => 'nullable|string|max:50',
        ]);

        $customer->update($validated);

        $request->validate([
            'bank_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'bank_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('bank_front_image')) {
            if ($customer->bank_front_image) {
                Storage::delete('public/' . $customer->bank_front_image);
            }
            if ($customer->bank_front_image && Storage::disk('public')->exists($customer->bank_front_image)) {
                Storage::disk('public')->delete($customer->bank_front_image);
            }
            $frontPath = $request->file('bank_front_image')->store('bank', 'public');
            $customer->bank_front_image = $frontPath;
        }

        if ($request->hasFile('bank_back_image')) {
            if ($customer->bank_back_image) {
                Storage::delete('public/' . $customer->bank_back_image);
            }
            if ($customer->bank_back_image && Storage::disk('public')->exists($customer->bank_back_image)) {
                Storage::disk('public')->delete($customer->bank_back_image);
            }
            $backPath = $request->file('bank_back_image')->store('bank', 'public');
            $customer->bank_back_image = $backPath;
        }

        $customer->bank_status = 'pending';
        $customer->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    public function submitKyc(Request $request)
    {
        $customerId = session('customer_id');
        $customer = Customer::where('user_id', $customerId)->firstOrFail();

        // Prevent update if KYC is already approved
        if ($customer->kyc_status === 'approved') {
            return back()->with('error', 'Your KYC is already approved and cannot be updated.');
        }

        // Validate input
        $validated = $request->validate([
            'kyc_doc_type' => 'required|string|in:NIC,Passport,DL',
            'kyc_doc_number' => 'required|string|max:255',
            'kyc_doc_front' => $customer->kyc_doc_front ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'kyc_doc_back' => $customer->kyc_doc_back ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        // Upload files if provided
        if ($request->hasFile('kyc_doc_front')) {
            if ($customer->kyc_doc_front) {
                Storage::delete('public/' . $customer->kyc_doc_front);
            }
            if ($customer->kyc_doc_front && Storage::disk('public')->exists($customer->kyc_doc_front)) {
                Storage::disk('public')->delete($customer->kyc_doc_front);
            }
            $frontPath = $request->file('kyc_doc_front')->store('kyc', 'public');
            $customer->kyc_doc_front = $frontPath;
        }

        if ($request->hasFile('kyc_doc_back')) {
            if ($customer->kyc_doc_back) {
                Storage::delete('public/' . $customer->kyc_doc_back);
            }
            if ($customer->kyc_doc_back && Storage::disk('public')->exists($customer->kyc_doc_back)) {
                Storage::disk('public')->delete($customer->kyc_doc_back);
            }
            $backPath = $request->file('kyc_doc_back')->store('kyc', 'public');
            $customer->kyc_doc_back = $backPath;
        }

        // Save the rest of the info
        $customer->kyc_doc_type = $validated['kyc_doc_type'];
        $customer->kyc_doc_number = $validated['kyc_doc_number'];
        $customer->kyc_status = 'pending'; // Set to pending on (re)submission
        $customer->save();

        return back()->with('success', 'KYC submitted successfully and is pending verification.');
    }



    public function updatePassword(Request $request)
    {
        $customerId = session('customer_id');
        $customer = Customer::findOrFail($customerId);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->with('password_error', 'Current password is incorrect.');
        }

        $customer->password = Hash::make($request->new_password);
        $customer->save();

        return back()->with('password_success', 'Password updated successfully!');
    }

    public function inviteeplace(Request $request)
    {
        $request->validate([
            'invitee_id' => 'required|exists:customers,user_id',
            'side' => 'required|in:left,right',
        ]);
        $customerId = session('customer_id');
        $customer = Customer::where('user_id', $customerId)->first();
        $invitee = Customer::where('user_id',$request->invitee_id)->first();

        if ($invitee->sponsor_id !== $customerId) {
            return redirect()->back()->with('error', 'You can only place your own invitees.');
        }
        if ($invitee->is_side_selected) {
            return redirect()->back()->with('error', 'This invitee has already been placed.');
        }
        if ($request->side === 'left') {
            $inviteeId = $invitee->user_id;

            // 1. Traverse downward (left children)
            $downward = [];
            $stack = [$customer]; // start from current user

            while (!empty($stack)) {
                $current = array_pop($stack);

                if ($current->left_child_id) {
                    $leftChild = Customer::where('user_id', $current->left_child_id)->first();
                    if ($leftChild) {
                        $downward[] = $leftChild;
                        $stack[] = $leftChild; // continue DFS
                    }
                }
            }

            // 2. Traverse upward (sponsors with this user as their left child)
            $upward = [];
            $current = $customer;
            while ($current->sponsor_id) {
                $sponsor = Customer::where('user_id', $current->sponsor_id)->first();
                if ($sponsor && $sponsor->left_child_id == $current->user_id) {
                    $upward[] = $sponsor;
                    $current = $sponsor;
                } else {
                    break;
                }
            }

            $current2 = $customer;
            while ($current2->user_id) {
                $user = Customer::where('left_child_id', $current2->user_id)->first();
                if ($user && $user->left_child_id == $current2->user_id) {
                    $upward[] = $user;
                    $current2 = $user;
                } else {
                    break;
                }
            }

            // 3. Combine all users: upward, current, and downward
            $allLeftUsers = array_merge($upward, [$customer], $downward);

            // 4. Assign invitee to the last left user
            $lastLeft = $customer;
            while ($lastLeft->left_child_id) {
                $lastLeft = Customer::where('user_id', $lastLeft->left_child_id)->first();
            }
            $lastLeft->left_child_id = $inviteeId;
            $lastLeft->save();

            // 5. Award points to all EXCEPT the invitee and status != 1
            foreach ($allLeftUsers as $user) {
                if ($user->user_id != $inviteeId && $user->status == 1) {
                    $user->left_side_points += 1;
                    $user->total_left_points +=1;
                    $user->save();
                }
            }
        } else {
            $inviteeId = $invitee->user_id;

            // 1. Traverse downward (right children)
            $downward = [];
            $stack = [$customer]; // start from current user

            while (!empty($stack)) {
                $current = array_pop($stack);

                if ($current->right_child_id) {
                    $rightChild = Customer::where('user_id', $current->right_child_id)->first();
                    if ($rightChild) {
                        $downward[] = $rightChild;
                        $stack[] = $rightChild; // continue DFS
                    }
                }
            }

            // 2. Traverse upward (sponsors with this user as their right child)
            $upward = [];
            $current = $customer;
            while ($current->sponsor_id) {
                $sponsor = Customer::where('user_id', $current->sponsor_id)->first();
                if ($sponsor && $sponsor->right_child_id == $current->user_id) {
                    $upward[] = $sponsor;
                    $current = $sponsor;
                } else {
                    break;
                }
            }

            $current2 = $customer;
            while ($current2->user_id) {
                $user = Customer::where('right_child_id', $current2->user_id)->first();
                if ($user && $user->right_child_id == $current2->user_id) {
                    $upward[] = $user;
                    $current2 = $user;
                } else {
                    break;
                }
            }

            // 3. Combine all right side users: upward, current user, downward
            $allRightUsers = array_merge($upward, [$customer], $downward);

            // 4. Assign invitee to last right user
            $lastRight = $customer;
            while ($lastRight->right_child_id) {
                $lastRight = Customer::where('user_id', $lastRight->right_child_id)->first();
            }
            $lastRight->right_child_id = $inviteeId;
            $lastRight->save();

            // 5. Award points to all EXCEPT the invitee and those with status != 1
            foreach ($allRightUsers as $user) {
                if ($user->user_id != $inviteeId && $user->status == 1) {
                    $user->right_side_points += 1;
                    $user->total_right_points += 1;
                    $user->save();
                }
            }
        }

        $invitee->is_side_selected = 1;
        $invitee->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }



    public function allInvitees(){
        $customerId = session('customer_id');
        if ($customerId === null) {
            return redirect()->route('customer.login')->with('error', 'Please log in to access your dashboard.');
        }
        $customer = Customer::where('user_id', $customerId)
            ->first();
        $invitees = Customer::where('sponsor_id', $customerId)->paginate(10);

        return view('StudentDashboard.invitees.index', compact('invitees', 'customer'));
    }

    public function sendEmailVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $customerId = session('customer_id');
        if ($customerId === null) {
            return redirect()->route('customer.login')->with('error', 'Please log in to access your dashboard.');
        }
        $customer = Customer::where('user_id', $customerId)
            ->first();

        // Check if email already exists
        if (Customer::where('email', $request->email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already in use. Please enter a different one.'
            ]);
        }

        $verificationCode = rand(100000, 999999);

        $customer->email_verification_code = $verificationCode;
        $customer->save();

        // Store in session for temporary check
        Session::put('email_change_code', $verificationCode);
        Session::put('email_change_target', $request->email);

        // Send Email
        Mail::to($request->email)->send(new EmailVerificationCodeMail($verificationCode));

        return response()->json(['success' => true]);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email',
            'email_verification_code' => 'required'
        ]);

        $code = Session::get('email_change_code');
        $targetEmail = Session::get('email_change_target');

        if (!$code || !$targetEmail) {
            return back()->with('error', 'No verification request found.');
        }

        if ($request->email_verification_code != $code || $request->new_email != $targetEmail) {
            return back()->with('error', 'Invalid verification code or email mismatch.');
        }

         $customerId = session('customer_id');
        if ($customerId === null) {
            return redirect()->route('customer.login')->with('error', 'Please log in to access your dashboard.');
        }
        $customer = Customer::where('user_id', $customerId)
            ->first();
        if($customer->email_verification_code == $request->email_verification_code){
            $customer->email = $request->new_email;
            $customer->save();
        }
        // Clear session
        Session::forget(['email_change_code', 'email_change_target']);

        return back()->with('success', 'Email updated successfully.');
    }

    public function sendPhoneVerificationCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|digits:10'
        ]);

        // Prevent sending to already existing phone numbers
        if (Customer::where('contact_number', $request->phone)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This phone number is already in use.'
            ]);
        }

        $customerId = session('customer_id');
        if ($customerId === null) {
            return redirect()->route('customer.login')->with('error', 'Please log in to access your dashboard.');
        }
        $customer = Customer::where('user_id', $customerId)
            ->first();

        $verificationCode = rand(100000, 999999);

        // Store code & phone in session
        Session::put('phone_change_code', $verificationCode);
        Session::put('phone_change_target', $request->phone);

        $customer->verification_code = $verificationCode;
        $customer->save();

        // Send SMS
        try {
            $message = "Your verification code is: $verificationCode";
            $this->sendSMS($request->phone, $message);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send SMS. ' . $e->getMessage()
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function updatePhone(Request $request)
    {
        $request->validate([
            'new_phone' => 'required|string|digits:10',
            'phone_verification_code' => 'required'
        ]);

        $code = Session::get('phone_change_code');
        $targetPhone = Session::get('phone_change_target');

        if (!$code || !$targetPhone) {
            return back()->with('error', 'No verification request found.');
        }

        if ($request->phone_verification_code != $code || $request->new_phone != $targetPhone) {
            return back()->with('error', 'Invalid code or phone mismatch.');
        }

        $customerId = session('customer_id');
        if ($customerId === null) {
            return redirect()->route('customer.login')->with('error', 'Please log in to access your dashboard.');
        }
        $customer = Customer::where('user_id', $customerId)
            ->first();
        if ($customer->verification_code == $request->phone_verification_code) {
            $customer->contact_number = $request->new_phone;
            $customer->save();
        }

        Session::forget(['phone_change_code', 'phone_change_target']);

        return back()->with('success', 'Phone number updated successfully.');
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
}
