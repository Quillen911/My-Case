<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document23</title>
</head>
<body>
    <h1>Düzenle</h1>
    @if(isset($success))
        <p style="color:green;">{{ $success }}</p>
    @endif
    <form action="{{ route('updateUser', $user->id) }}" method="POST">
        @csrf
        <label>Kullanıcı Adı:</label>
        <input type="text" name="username" value="{{ old('username', $user->username) }}"><br>
        @error('username')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <label>Kullanıcı Email:</label>
        <input type="text" name="email" value="{{ old('email', $user->email) }}"><br>
        @error('email')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <button type="submit">Kaydet</button>
    </form>
    <a href="{{ route('listUser') }}">Geri Dön</a>
</body>
</html>