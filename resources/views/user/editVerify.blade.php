<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Admin Onayı</h1>

    <form action="{{route('postEditVerify')}}" method="POST" >
        @csrf
        <input type="password" name="password" placeholder="Admin Şifre" required><br>
        <button type="submit" >Gönder</button>
    </form>
    <a href="{{ route('listUser') }}">Geri Dön</a>
</body>
</html>