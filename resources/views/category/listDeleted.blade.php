<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silinmiş Kategoriler</title>
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
            max-width: 900px;
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
            background-color: #6c757d;
            color: white;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        tbody tr {
            color: #999;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            table {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗃️ Silinmiş Kategoriler</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori Adı</th>
                    <th>Silinme Tarihi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->categoryTitle }}</td>
                        <td>{{ $c->deleted_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('category.list') }}" class="back-btn">🔙 Aktif Kategorilere Dön</a>
    </div>
</body>
</html>
