<table>
    <thead>
        <tr>
            <th><b>NO</b></th>
            <th><b>Title</b></th>
            <th><b>Role Name</b></th>
            <th><b>Company Name</b></th>
            <th><b>Location</b></th>
            <th><b>Start Date</b></th>
            <th><b>Closing Date</b></th>
            <th><b>Type Of Work</b></th>
            <th><b>Industry</b></th>
            <th><b>Description</b></th>
            <th><b>Requirements</b></th>
            <th><b>Salary Range</b></th>
            <th><b>Skills</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $job)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $job['title'] }}</td>
                <td>{{ $job['role_name'] }}</td>
                <td>{{ $job['company_name'] }}</td>
                <td>{{ $job['location'] }}</td>
                <td>{{ $job['start_date'] }}</td>
                <td>{{ $job['end_date'] }}</td>
                <td>{{ $job['type_of_work_name'] }}</td>
                <td>{{ $job['industry_name'] }}</td>
                <td>{{ $job['description'] }}</td>
                <td>{{ $job['requirement'] }}</td>
                <td>{{ $job['salary_range'] }}</td>
                <td>{{ $job['skill_name'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
