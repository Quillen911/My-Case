<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silinmiş Ürünler</title>
</head>
<body>
    <h1>Silinmiş Ürünler</h1>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ürün Adı</th>
                <th>Ürün Kategori Numarası</th>
                <th>Ürün Barkodu</th>
                <th>Ürün Durumu</th>
                <th>Silinme Tarihi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $p)
                <tr style="color:#aaa;">
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->productTitle }}</td>
                    <td>{{ $p->productCategoryId }}</td>
                    <td>{{ $p->productBarcode }}</td>
                    <td>{{ $p->productStatus }}</td>
                    <td>{{ $p->deleted_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('list') }}">Aktif Kategorilere Dön</a>
</body>
</html>