<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Düzenle</h1>
    <form action="{{ route('editAdmin', $admin->id) }}" method="POST">
        @csrf
        <label>Kullanıcı Adı:</label>
        <input type="text" name="username" value="{{ $admin->username }}"><br>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $admin->email }}"><br>
        <button type="submit">Kaydet</button>
    </form>
    <a href="{{ route('admin.list') }}">Geri Dön</a>
</body>
</html>