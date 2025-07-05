<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentlist</title>
</head>
<body>
    <h1>Kategori Listele</h1>
    <table border="5" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Kategori ID</th>
                <th>Kategori Adı</th>
                <th>Kategori Açıklaması</th>
                <th>Kategori Durumu</th>
                <th>               </th>
                <th>               </th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $c)
                <tr>
                    <td> {{ $c->id }} </td>
                    <td> {{ $c->categoryTitle }} </td>
                    <td> {{ $c->categoryDesc }} </td>
                    <td> {{ $c->categoryStatus }} </td>
                    <td> <a href="{{route('editCategory', $c->id) }}">Düzenle</a></td>
                    <td>
                        <form action="{{route('deleteCategory', $c->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type='submit' onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('main') }}" class="back-btn">Geri Dön</a><br>
    <a href="{{ route('listDeleted') }}" class="back-btn">Silinenler</a>
</body>
</html>