<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You and Receipt</title>
</head>

<body>
    <table
        style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border-collapse: collapse; border: 1px solid #ccc;">
        <tr>
            <td style="text-align: center;">
                <h2>Thank You for Your Order!</h2>
            </td>
        </tr>
        <tr>
            <td>
                <p>Dear {{ $user->name }},</p>
                <p>Thank you for your recent order. We appreciate your business and would like to confirm that your
                    order number {{ $order->id }} has been processed successfully.</p>
                <p>Please find attached a PDF receipt for your reference.</p>
                <p>If you have any questions or require further assistance, feel free to contact our support team.</p>
                <p>Once again, thank you for choosing our services!</p>
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
