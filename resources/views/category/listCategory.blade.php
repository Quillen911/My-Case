<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Listele</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px;
            color: #333;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 300;
            position: relative;
            color: #333;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        thead {
            background-color: #667eea;
            color: white;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
            transition: 0.2s;
        }

        a,
        .back-btn,
        button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px 3px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        a:hover,
        .back-btn:hover,
        button:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        a {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .back-btn {
            background-color: #6c757d;
            color: white;
        }

        button {
            background-color: #dc3545;
            color: white;
        }

        button:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Kategori Listele</h1>

        <table>
            <thead>
                <tr>
                    <th>Kategori ID</th>
                    <th>Kategori Adı</th>
                    <th>Kategori Açıklaması</th>
                    <th>Kategori Durumu</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->categoryTitle }}</td>
                        <td>{{ $c->categoryDesc }}</td>
                        <td>{{ $c->categoryStatus }}</td>
                        <td>
                            <a href="{{ route('editCategory', $c->id) }}">✏️ Düzenle</a>
                        </td>
                        <td>
                            <form action="{{ route('deleteCategory', $c->id) }}" method="POST" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">🗑️ Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('main') }}" class="back-btn">🔙 Geri Dön</a>
        <a href="{{ route('listDeleted') }}" class="back-btn">🗃️ Silinenler</a>
    </div>
</body>
</html>
