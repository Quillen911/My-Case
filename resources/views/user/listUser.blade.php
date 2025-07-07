<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Kullanıcılar</h1>
    <table border="5" cellpadding="8" cellspacing="0" >
        <thead>
            <tr>
                <th>Kullanıcı ID</th>
                <th>Kullanıcı Adı</th>
                <th>Kullanıcı Email</th>
                <th>               </th>
                <th>               </th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $u)
                <tr>
                    <td> {{$u->id}} </td>
                    <td> {{$u->username}} </td>
                    <td> {{$u->email}} </td>
                    <td> <a href="{{route('editUser', $u->id)}}" method="POST">Düzenle</a></td>
                    <td> 
                
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('main')}}" class="back-btn" >Geri Dön</a><br>
</body>
</html>