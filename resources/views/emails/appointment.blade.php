<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <style>
        .download-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        
        p {
            /* text-align: justify; */
            font-size: 16px;
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding-top:30px;padding-bottom:30px ">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="border-collapse: collapse; background-color: #ffffff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin: 20px;">
                    <!-- Email Header -->

                    <tr>
                        <td style="padding: 20px; border: 1px solid #ddd;">
                            
                            <p>{!! $emailMessage !!}</p>
                            <p><strong>Doctor:</strong>{{ $appointment->doctor->name }}</p>
                            <p><strong>Date:</strong>{{ $appointment->appointment_date->format('Y M d') }}</p>
                            <p><strong>Time:</strong> {{ $appointment->appointment_time->format('h:i A') }}</p>
                            <p><strong>Status:</strong>{{ $appointment->status }}</p>
                            <p>Best regards,<br> ellodoc
                            </p>
                        </td>
                    </tr>
                    <!-- Email Footer -->
                    <tr>
                        <td align="center" style="background-color: #f8f8f8; padding: 20px; font-size: 12px; color: #555;">
                            &copy; {{ date('Y') }} ellodoc. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>