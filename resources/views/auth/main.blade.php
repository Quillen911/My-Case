<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
</head>
<body>

    <h1>Hoş Geldiniz {{auth()->user()->username }}</h1>


    <a href="/user/addUser">Kullanıcı Ekle</a><br>
    <a href="/user/listUser">Tüm Kullanıcılar</a><br>
    <a href="/add">Kategori Ekle</a><br>
    <a href="/product/add">Ürün Ekle</a><br>
    <a href="/product/list">Ürün Listesi</a><br>
    <a href="/category-list">Kategori Listesi</a>
    <br><br>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Çıkış yap</button>
    </form>

</body>
</html>