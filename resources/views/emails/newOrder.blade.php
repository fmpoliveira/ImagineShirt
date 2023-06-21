<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Processing Notification</title>
</head>

<body>
    <table
        style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border-collapse: collapse; border: 1px solid #ccc;">
        <tr>
            <td style="text-align: center;">
                <h2>Order Processing Notification</h2>
            </td>
        </tr>
        <tr>
            <td>
                <p>Dear {{ $user->name }},</p>
                <p>We wanted to inform you that your order number {{ $order->id }} is currently being processed. We
                    appreciate your business and will keep you updated on the progress.</p>
                <p>If you have any questions or concerns, please don't hesitate to contact our support team.</p>
                <p>Thank you for choosing our services!</p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <p style="font-size: 14px; color: #888;">This is an automated email, please do not reply.</p>
            </td>
        </tr>
    </table>
</body>

</html>
