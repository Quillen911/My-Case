<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document2</title>
</head>
<body>
    <h1>Düzenle</h1>
    <form action="{{ route('updateProduct', $product->id) }}" method="POST">
        @csrf
        <label>Ürün Adı:</label>
        <input type="text" name="productTitle" value="{{ $product->productTitle }}"><br>
        <label>Ürün Kategori Numarası:</label>
        <input type="text" name="productCategoryId" value="{{ $product->productCategoryId }}"><br>
        <label>Ürün Barkodu:</label>
        <input type="text" name="productBarcode" value="{{ $product->productBarcode }}"><br>
        <label>Ürün Durumu:</label>
        <input type="text" name="productStatus" value="{{ $product->productStatus }}"><br>
        <button type="submit">Kaydet</button>
    </form>
    <a href="{{ route('list') }}">Geri Dön</a>
</body>
</html>