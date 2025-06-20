<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; background: white; padding: 30px; margin: auto; border-radius: 8px;">
        <h2 style="color: #333;">Verify Your Email</h2>
        <p>Hi there,</p>
        <p>To continue updating your email, please use the following verification code:</p>
        <h1 style="text-align: center; color: #0d6efd;">{{ $code }}</h1>
        <p>This code is valid for a short period of time. If you did not request this, you can ignore this email.</p>
        <p style="margin-top: 30px;">Thanks,<br>The Better Way Team</p>
    </div>
</body>
</html>
