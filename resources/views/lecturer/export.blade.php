<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Matriculation Number</th>
            <th>Assessment Score</th>
            <th>Examination Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->firstname}}, {{$user->middlename}} {{$user->lastname}}</td>
                <td>{{$user->identification_number}}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
