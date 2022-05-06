<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($personales as $personale)
        <tr>
            <td>{{ $personale->user->name }}</td>
            <td>{{ $personale->user->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>