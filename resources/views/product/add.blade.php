<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ürün Ekle</h1>

    <form action="{{route('addpost')}}" method="POST" >
        @csrf
        <input type="text" name="productTitle" placeholder='Ürün Adı' required ><br>
        <input type="text" name="productCategoryId" placeholder='Ürün Kategori Numarası' required ><br>
        <input type="text" name="productBarcode" placeholder='Ürün Barkod' required ><br>
        <input type="text" name="productStatus" placeholder='Ürün Durumu' required ><br>
        <button type='submit'>Ekle</button>

    </form>

    <form action="{{route('main')}}" method="GET" >
        <button type='submit'>Geri dön</button>
    </form>

</body>
</html>