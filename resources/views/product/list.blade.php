<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ürün Listesi</h1>
    <table border="5" cellpadding="8" cellspacing="0" >
        <thead>
            <tr>
                <th>Ürün ID</th>
                <th>Ürün Adı</th>
                <th>Ürün Numarası</th>
                <th>Ürün Barkodu</th>
                <th>Ürün Açıklaması</th>
                <th>               </th>
                <th>               </th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $p)
                <tr>
                    <td> {{ $p->id }} </td>
                    <td> {{ $p->productTitle }} </td>
                    <td> {{ $p->productCategoryId }} </td>
                    <td> {{ $p->productBarcode }} </td>
                    <td> {{ $p->productStatus }} </td>
                    <td> <a href="{{ route('editProduct', $p->id) }} ">Düzenle</a> </td>
                    <td>
                        <form action="{{ route('deleteProduct', $p->id) }} " method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    <a href="{{ route('main') }}" class="back-btn">Geri Dön</a><br>
    <a href="{{ route('productListDeleted') }}" class="back-btn">Silinenler</a>
</body>
</html>