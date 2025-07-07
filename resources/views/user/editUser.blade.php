<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document23</title>
</head>
<body>
    <h1>Düzenle</h1>
    <form action="{{ route('updateUser', $user->id) }}" method="POST">
        @csrf
        <label>Kullanıcı Adı:</label>
        <input type="text" name="username" value="{{ $user->username }}"><br>
        <label>Kullanıcı Email:</label>
        <input type="text" name="email" value="{{ $user->email }}"><br>
        <button type="submit">Kaydet</button>
    </form>
    <a href="{{ route('listUser') }}">Geri Dön</a>
</body>
</html>