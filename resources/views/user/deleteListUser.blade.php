<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silinmiş Kullanıcılar</title>
</head>
<body>
    <h1>Silinmiş Kullanıcılar</h1>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kullanıcı Adı</th>
                <th>Kullanıcı Email</th>
                <th>Silinme Tarihi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $u)
                <tr style="color:#aaa;">
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->deleted_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('listUser') }}">Aktif Kullanıcılara Dön</a>
</body>
</html>