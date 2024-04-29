<x-mail::message>
<h1>Dear {{ $data['first_name'] }},</h1>

We regret inform you that your job application has been rejected on Job Matched App.

Here are the details of your job application:

Position: {{ $data['role_name'] }} <br>
Company: {{ $data['company_name'] }}

Please login to the Job Matched app for further details.

Best regards,<br>
Job Matched Team
</x-mail::message>
