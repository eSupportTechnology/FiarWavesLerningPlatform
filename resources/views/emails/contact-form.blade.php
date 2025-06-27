<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <table style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <tr>
            <td style="background-color: #ee1831; color: #ffffff; padding: 20px; text-align: center;">
                <h2 style="margin: 0;">New Contact Message</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <p><strong>Name:</strong> {{ $data['name'] }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>
                <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
                <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
                <p><strong>Message:</strong></p>
                <p style="background: #f9f9f9; padding: 15px; border-left: 4px solid #ee1831; white-space: pre-line;">
                    {{ $data['message'] }}
                </p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f1f1f1; color: #555555; padding: 15px; text-align: center; font-size: 12px;">
                © {{ date('Y') }} Edukon. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
