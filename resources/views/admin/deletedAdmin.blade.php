<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Silinmiş Kullanıcılar</h1>
    <table border="1" cellpadding="8" celling="0" >
        <thead>
            <tr>
                <th>Admin ID</th>
                <th>Admin Kullanıcı Adı</th>
                <th>Admin Email</th>
                <th>Silinme Tarihi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admin as $a)
            <tr>
                <td>{{$a->id}} </td>
                <td>{{$a->username}} </td>
                <td>{{$a->email}} </td>
                <td>{{$a->deleted_at}} </td>
            </tr>    
            @endforeach    
        </tbody>
    </table>
    <a href="{{route('admin.list')}}">Aktif Kullanıcılara Dön</a>
</body>
</html>