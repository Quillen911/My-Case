<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Yeni Kullanıcı Ekle</h1>

    <form action="{{route('user.postUser')}}" method="POST" >
        @csrf
        <input type="text" name="username" placeholder='Kullanıcı Adı' required ><br>
        <input type="email" name="email" placeholder='Kullanıcı Email' required ><br>
        <input type="password" name="password" placeholder='Kullanıcı Şifre' required ><br>
        <button type='submit'>Ekle</button>
    </form>

    <form action="{{route('main')}}" method="GET" >
        <button type='submit'>Geri dön</button>
    </form>

</body>
</html>