<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
</head>
<body>
@if(isset($error) && $error)
        <p style="color:red;">{{ $error }}</p>
    @endif
    @if(isset($success) && $success)
        <p style="color:green;">{{ $success }}</p>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required ><br>
        <input type="password" name="password" placeholder="Şifre" required ><br>
        <button type="submit" >Giriş Yap</button>
    </form>
</body>
</html>