<x-mail::message>
<h1>Dear {{ $data['first_name'] }},</h1>

Thank you for registering with Job Matched. We're excited to have you on board! To finalize your registration, please enter the One-Time Password (OTP) provided below:

OTP: {{ $data['otp'] }}

Please note that this OTP is only valid for 30 mins and can only be used once. If you haven't initiated this registration, you can safely ignore this email.

Best regards,<br>
Job Matched Team
</x-mail::message>

