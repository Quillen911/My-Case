<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Yeni Kullanıcı Ekle</h1>

    @if(isset($error))
        <p style="color:red;">{{ $error }}</p>
    @endif
    @if(isset($success))
        <p style="color:green;">{{ $success }}</p>
    @endif

    <form action="{{route('user.postUser')}}" method="POST" >
        @csrf
        <input type="text" name="username" placeholder='Kullanıcı Adı' required value="{{ old('username', $old['username'] ?? '') }}"><br>
        <input type="email" name="email" placeholder='Kullanıcı Email' required value="{{ old('email', $old['email'] ?? '') }}"><br>
        <input type="password" name="password" placeholder='Kullanıcı Şifre' required ><br>
        <button type='submit'>Ekle</button>
    </form>

    <form action="{{route('main')}}" method="GET" >
        <button type='submit'>Geri dön</button>
    </form>

</body>
</html>