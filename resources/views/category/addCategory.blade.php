<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Kategori Ekle</h1>

    <form action="{{route('add.show')}}" method="POST" >
        @csrf 
        <input type="text" name="categoryTitle" placeholder='Kategori Adı' required ><br>
        <input type="text" name="categoryDesc" placeholder='Kategori Açıklaması' required ><br>
        <input type="text" name="categoryStatus" placeholder='Kategori Durumu' required ><br>
        <button type='submit'>Ekle</button>
    </form>
    <form action="{{route('main')}}" method="GET" >
        <button type='submit'>Geri dön</button>
    </form>
</body>
</html>