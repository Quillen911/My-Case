<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kayıt</title>
</head>
<body>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Kullanıcı Adı" required ><br>
        <input type="email" name="email" placeholder="Email" required ><br>
        <input type="password" name="password" placeholder="Şifre" required ><br>
        <button type="submit" >Kayıt Ol</button>
    </form>
    <form action="{{route('login.form')}}" method="GET" >
        @csrf
        <button type="submit" >Giriş Yap</button>
    </form>
</body>
</html>