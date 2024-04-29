
<x-mail::message>
<h1>Hi {{ $data['first_name'] }},</h1>
<p>Your application has been selected for the below job.</p>

Job name - {{ $data['role_name'] }}

Thanks,<br>
Job Matched Admin
</x-mail::message>

