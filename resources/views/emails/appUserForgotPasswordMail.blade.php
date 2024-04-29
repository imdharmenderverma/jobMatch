<x-mail::message>
<h1>Dear {{ $data['first_name'] }},</h1>

We received a request to reset your password for your Job Matched account. To proceed with the password reset, please use the following One-Time Password (OTP):

OTP: {{ $data['otp'] }}

Please note that this OTP is valid for a limited time and can only be used once. For security reasons, please do not share this OTP with anyone.

If you did not request a password reset, please disregard this email. Your account remains secure, and no further action is required.

Best regards,<br>
Job Matched Team
</x-mail::message>
