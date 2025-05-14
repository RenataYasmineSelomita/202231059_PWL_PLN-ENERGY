<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Username</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
