<?php

namespace App\Services;

class DailyIncomeService
{
    public function process()
    {
        $customers = \App\Models\Customer::where('status', 1)->where('kyc_status', 'approved')->get();
        foreach ($customers as $customer) {

            $wallet = \App\Models\Wallet::firstOrCreate(
                ['customer_id' => $customer->user_id],
                ['balance' => 0, 'total_deposited' => 0, 'total_withdrawn' => 0, 'status' => 'active', 'currency' => 'LKR']
            );


            if ($wallet) {
                // Calculate daily income based on the customer's points
                $dailyIncome = $this->calculateDailyIncome($customer);

                if ($dailyIncome <= 0) {
                    continue; // Skip if no income to credit
                }

                // Update wallet balance
                $wallet->balance += $dailyIncome;
                $wallet->total_deposited += $dailyIncome;
                $wallet->save();

                // Log the transaction
                \App\Models\WalletTransaction::create([
                    'wallet_id' => $wallet->id,
                    'transaction_type' => 'deposit',
                    'amount' => $dailyIncome,
                    'description' => 'Daily income credited',
                    'status' => 'completed',
                    'transaction_date' => now(),
                    'currency' => 'LKR',
                ]);
            }
        }
    }

    public function calculateDailyIncome($customer)
    {
        $activeLeft = $customer->active_left_points ?? 0;
        $activeRight = $customer->active_right_points ?? 0;

        $dailyLeft = $customer->left_side_points ?? 0;
        $dailyRight = $customer->right_side_points ?? 0;

        $left = $activeLeft + $dailyLeft ?? 0;
        $right = $activeRight + $dailyRight ?? 0;

        $minPoints = min($left, $right);

        if ($customer->is_first_time_withdrawal == 0) {
            // Allow minimum 1
            if ($minPoints == 1) {
                $dailyPoints = 1;
            } else {
                $evenMin = $minPoints % 2 === 0 ? $minPoints : $minPoints - 1;
                $dailyPoints = min($evenMin, 10);
            }
        } else {
            // After first withdrawal, minimum must be 2 and even
            if ($minPoints >= 2) {
                $adjusted = $minPoints % 2 == 0 ? $minPoints : $minPoints - 1;
                $dailyPoints = min($adjusted, 10);
            } else {
                $dailyPoints = 0;
            }
        }
        $dailyIncome = $dailyPoints * 1000; // Adjust this logic as per your requirements

        if (
            $customer->is_first_time_withdrawal == 0 &&
            $customer->left_side_points >= 1 &&
            $customer->right_side_points >= 1
        ) {
            $customer->is_first_time_withdrawal = 1;
        }

        $customer->used_left_points += $dailyPoints;
        $customer->used_right_points += $dailyPoints;

        if ($dailyPoints == 10) {
            // Deduct points
            $customer->left_side_points = 0;
            $customer->right_side_points = 0;
            $customer->active_left_points = 0;
            $customer->active_right_points = 0;
        } else {
            // Deduct points

            $customer->active_left_points += $customer->left_side_points;
            $customer->active_right_points += $customer->right_side_points;

            $customer->active_left_points -= $minPoints;
            $customer->active_right_points -= $minPoints;

            $customer->left_side_points = 0;
            $customer->right_side_points = 0;
        }

        $customer->save();

        return $dailyIncome;
    }
}
