<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password | Better Way</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 32px;
        }
        .logo {
            text-align: center;
            margin-bottom: 24px;
        }
        .logo img {
            max-width: 180px;
        }
        h1 {
            color: #111827;
            font-size: 22px;
            margin-bottom: 16px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #4b5563;
        }
        .btn {
            display: inline-block;
            margin-top: 24px;
            padding: 12px 24px;
            background-color: #f15a24;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
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
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{asset('frontend/assets/images/newlogo.png')}}" alt="Better Way Logo">
        </div>

        <!-- Heading -->
        <h1>Password Reset Request</h1>

        <!-- Message -->
        <p>Hello,</p>
        <p>We received a request to reset your password for your Better Way account.</p>
        <p>If you did not make this request, you can ignore this email.</p>
        <p>Otherwise, click the button below to reset your password:</p>

        <!-- Call to Action -->
        <p style="text-align: center;">
            <a href="{{ $resetUrl }}" class="btn">Reset Password</a>
        </p>

        <p>This password reset link will expire in 60 minutes.</p>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Better Way. All rights reserved.
        </div>
    </div>
</body>
</html>
