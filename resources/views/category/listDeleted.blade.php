<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silinmiş Kategoriler</title>
</head>
<body>
    <h1>Silinmiş Kategoriler</h1>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori Adı</th>
                <th>Silinme Tarihi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $c)
                <tr style="color:#aaa;">
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->categoryTitle }}</td>
                    <td>{{ $c->deleted_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('category.list') }}">Aktif Kategorilere Dön</a>
</body>
</html>