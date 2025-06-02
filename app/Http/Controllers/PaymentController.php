<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\OnepayHelper;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment.form');
    }

    public function create(Request $request)
    {
        $amount = $request->input('amount');
        $currency = 'LKR';

        $hash = OnepayHelper::generateHash($currency, $amount);

        $payload = [
            'currency' => $currency,
            'app_id' => config('onepay.app_id'),
            'hash' => $hash,
            'amount' => $amount,
            'reference' => uniqid('DSA_'),
            'customer_first_name' => $request->first_name,
            'customer_last_name' => $request->last_name,
            'customer_phone_number' => $request->phone,
            'customer_email' => $request->email,
            'transaction_redirect_url' => route('payment.callback'),
            'additionalData' => 'DSA_Laravel_Integration',
        ];

        $response = Http::withHeaders([
            'Authorization' => config('onepay.api_key'),
        ])->post(config('onepay.base_url') . '/checkout/link/', $payload);

        if ($response->successful() && isset($response['data']['gateway']['redirect_url'])) {
            return redirect()->away($response['data']['gateway']['redirect_url']);
        }

        return back()->with('error', 'Failed to create payment.')->withErrors($response->json());
    }

    public function callback(Request $request)
    {
        return view('payment.callback', ['data' => $request->all()]);
    }

}
