<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document1</title>
</head>
<body>
    <h1>Düzenle</h1>
    <form action="{{ route('editCategory', $category->id) }}" method="POST">
        @csrf
        <label>Kategori Adı:</label>
        <input type="text" name="categoryTitle" value="{{ $category->categoryTitle }}"><br>
        <label>Kategori Açıklaması:</label>
        <input type="text" name="categoryDesc" value="{{ $category->categoryDesc }}"><br>
        <label>Kategori Durumu:</label>
        <input type="text" name="categoryStatus" value="{{ $category->categoryStatus }}"><br>
        <button type="submit">Kaydet</button>
    </form>
    <a href="{{ route('category.list') }}">Geri Dön</a>
</body>
</html>