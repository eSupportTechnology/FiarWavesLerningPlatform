<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset Code</title>
</head>
<body>
    <h2>Password Reset Code</h2>
    <p>Hello <strong>{{ $customer->name }}</strong>,</p>
    <p>Your password reset code is:</p>
    <h3 style="color:#007bff;">{{ $code }}</h3>
    <p>Please use this code to verify your password change request.</p>
    <br>
    <small>If you didn’t request this, you can safely ignore this email.</small>
</body>
</html>
