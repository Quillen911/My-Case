<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Kategori Ekle</h1>
    @if(isset($success))
        <p style="color:green;">{{ $success }}</p>
    @endif
    @if(isset($error))
        <p style="color:red;">{{ $error }}</p>
    @endif
    <form action="{{route('add.show')}}" method="POST" >
        @csrf 
        <input type="text" name="categoryTitle" placeholder='Kategori Adı' required value="{{ isset($old['categoryTitle']) ? $old['categoryTitle'] : old('categoryTitle') }}"><br>
        @error('categoryTitle')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <input type="text" name="categoryDesc" placeholder='Kategori Açıklaması' required value="{{ isset($old['categoryDesc']) ? $old['categoryDesc'] : old('categoryDesc') }}"><br>
        @error('categoryDesc')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <input type="text" name="categoryStatus" placeholder='Kategori Durumu' required value="{{ isset($old['categoryStatus']) ? $old['categoryStatus'] : old('categoryStatus') }}"><br>
        @error('categoryStatus')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <button type='submit'>Ekle</button>
    </form>
    <form action="{{route('main')}}" method="GET" >
        <button type='submit'>Geri dön</button>
    </form>
</body>
</html>