<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminler</title>
</head>
<body>
    <h1><strong>Tüm Adminler</strong></h1>


    <table border="5" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Admin Kullanıcı Adı</th>
                <th>Email</th>
                <th>     </th>
                <th>     </th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }} </td>
                    <td>{{ $admin->username }} </td>
                    <td>{{ $admin->email }} </td>
                    <td><a href="{{ route('editAdmin', $admin->id) }}" >Düzenle</a> </td>
                    <td>
                        <form action="{{ route('deleteAdmin', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    <a href="{{route('deletedAdmin')}}">Silinen Kullanıcılar</a><br>
    <a href="{{ route('main') }}" class="back-btn">Geri Dön</a>
</body>
</html>