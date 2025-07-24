<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset Code | Better Way</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 32px;
        }
        .email-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .email-header h2 {
            color: #111827;
            font-size: 24px;
            margin-bottom: 0;
        }
        .email-content {
            font-size: 16px;
            line-height: 1.6;
        }
        .reset-code {
            text-align: center;
            margin: 24px 0;
        }
        .reset-code h3 {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 24px;
            letter-spacing: 2px;
        }
        .footer {
            margin-top: 32px;
            font-size: 14px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Password Reset Code</h2>
        </div>

        <div class="email-content">
            <p>Hello <strong>{{ $customer->name }}</strong>,</p>
            <p>You requested to reset your password. Please use the code below to complete your request:</p>

            <div class="reset-code">
                <h3>{{ $code }}</h3>
            </div>

            <p>This code will expire in 15 minutes. If you didn’t request a password reset, you can safely ignore this email.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Better Way. All rights reserved.
        </div>
    </div>
</body>
</html>
