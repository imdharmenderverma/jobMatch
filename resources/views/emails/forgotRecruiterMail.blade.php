<x-mail::message>
    <h1>Hello!</h1>

    We have received a request to reset your password for your Job Matched account. To proceed with the password reset,
    please click on the link below:

    Reset Password Link: <a href="{{ $data['url'] }}">{{ $data['url'] }}</a>

    Please note that this link is time-sensitive and will expire after a certain period for security purposes. If the
    link has expired, you can request another password reset by visiting the Job Matched login page and clicking on the
    "Forgot Password" or "Reset Password" link.

    If you did not initiate this password reset request, please disregard this email. Your account remains secure, and
    no further action is required.

    Best regards,<br>
    Job Matched Team
</x-mail::message>
