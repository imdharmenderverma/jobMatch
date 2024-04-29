<x-mail::message>
<h1>Hi {{ $name }},</h1>

Thank you for registering your business with Job Matched. Please click this  <a href="{{  route('verify-email', $id)}}" style="font-weight: 900; color: #0e4c56;text-decoration: none;">link</a> to verify your email address and login with the system.</p>

Thanks,<br>
Job Matched Team
</x-mail::message>
