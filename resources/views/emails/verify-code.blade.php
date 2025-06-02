<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .code-box {
            font-size: 24px;
            font-weight: bold;
            color: #e74c3c;
            background: #f2f2f2;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <p>Hello,</p>
    <p>Your DSA Academy email verification code is:</p>
    <p class="code-box">{{ $code }}</p>
    <p>Enter this code on the website to complete your registration.</p>
    <br>
    <p>Thanks,<br>DSA Academy Team</p>
</body>
</html>
