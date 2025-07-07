<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ürün Ekle</h1>
    @if(isset($success))
        <p style="color:green;">{{ $success }}</p>
    @endif
    @if(isset($error))
        <p style="color:red;">{{ $error }}</p>
    @endif
    <form action="{{route('product.addpost')}}" method="POST" >
        @csrf
        <input type="text" name="productTitle" placeholder='Ürün Adı' required value="{{ old('productTitle') }}"><br>
        @error('productTitle')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <select name="productCategoryId">
            <option value="">Kategori Seçiniz</option>
            @foreach($categories as $c)
                <option value="{{$c->id}}" {{ old('productCategoryId') == $c->id ? 'selected' : '' }}>{{$c->categoryTitle}}</option>
            @endforeach
        </select><br>
        @error('productCategoryId')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <input type="text" name="productBarcode" placeholder='Ürün Barkod' required value="{{ old('productBarcode') }}"><br>
        @error('productBarcode')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <input type="text" name="productStatus" placeholder='Ürün Durumu' required value="{{ old('productStatus') }}"><br>
        @error('productStatus')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <button type='submit'>Ekle</button>
    </form>
    <form action="{{route('main')}}" method="GET" >
        <button type='submit'>Geri dön</button>
    </form>
</body>
</html>