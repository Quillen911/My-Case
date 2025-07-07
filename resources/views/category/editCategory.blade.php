<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document1</title>
</head>
<body>
    <h1>Düzenle</h1>
    @if(isset($success))
        <p style="color:green;">{{ $success }}</p>
    @endif
    <form action="{{ route('editCategory', $category->id) }}" method="POST">
        @csrf
        <label>Kategori Adı:</label>
        <input type="text" name="categoryTitle" value="{{ old('categoryTitle', $category->categoryTitle) }}"><br>
        @error('categoryTitle')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <label>Kategori Açıklaması:</label>
        <input type="text" name="categoryDesc" value="{{ old('categoryDesc', $category->categoryDesc) }}"><br>
        @error('categoryDesc')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <label>Kategori Durumu:</label>
        <input type="text" name="categoryStatus" value="{{ old('categoryStatus', $category->categoryStatus) }}"><br>
        @error('categoryStatus')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <button type="submit">Kaydet</button>
    </form>
    <a href="{{ route('category.list') }}">Geri Dön</a>
</body>
</html>