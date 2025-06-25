<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Notifications\InviteCodeNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendRegistrationEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $customer, $token, $inviteCode;

    /**
     * Create a new job instance.
     */
    public function __construct(Customer $customer, string $token, string $inviteCode)
    {
        $this->customer = $customer;
        $this->token = $token;
        $this->inviteCode = $inviteCode;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->customer->notify(new VerifyEmailNotification($this->token));
            $this->customer->notify(new InviteCodeNotification($this->inviteCode));
        } catch (\Throwable $e) {
            Log::error('SendRegistrationEmails Job Failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e; // rethrow so the job still fails properly
        }
    }
}
