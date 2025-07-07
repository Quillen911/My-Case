<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document2</title>
</head>
<body>
    <h1>Düzenle</h1>
    @if(isset($success))
        <p style="color:green;">{{ $success }}</p>
    @endif
    <form action="{{ route('updateProduct', $product->id) }}" method="POST">
        @csrf
        <label>Ürün Adı:</label>
        <input type="text" name="productTitle" value="{{ old('productTitle', $product->productTitle) }}"><br>
        @error('productTitle')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <label>Ürün Kategori Numarası:</label>
        <input type="text" name="productCategoryId" value="{{ old('productCategoryId', $product->productCategoryId) }}"><br>
        @error('productCategoryId')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <label>Ürün Barkodu:</label>
        <input type="text" name="productBarcode" value="{{ old('productBarcode', $product->productBarcode) }}"><br>
        @error('productBarcode')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <label>Ürün Durumu:</label>
        <input type="text" name="productStatus" value="{{ old('productStatus', $product->productStatus) }}"><br>
        @error('productStatus')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <button type="submit">Kaydet</button>
    </form>
    <a href="{{ route('list') }}">Geri Dön</a>
</body>
</html>