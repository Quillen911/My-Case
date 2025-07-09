<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Listesi</title>
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
            padding: 20px;
        }

        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            position: relative;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
            animation: shimmer 2s infinite linear;
        }

        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: 200px 0; }
        }

        .header {
            padding: 30px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
        }

        h1 {
            font-size: 2.5em;
            font-weight: 300;
            margin-bottom: 10px;
        }

        .message {
            padding: 12px 20px;
            border-radius: 8px;
            margin: 20px 40px;
            font-weight: 500;
            text-align: center;
            animation: slideIn 0.5s ease-out;
        }

        .error {
            background-color: #ffebee;
            color: #c62828;
            border-left: 4px solid #e53935;
        }

        .success {
            background-color: #e8f5e8;
            color: #2e7d32;
            border-left: 4px solid #4caf50;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-container {
            padding: 40px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th, td {
            padding: 15px 12px;
            text-align: left;
            position: relative;
        }

        th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 13px;
        }

        tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr:hover {
            background-color: #f8f9ff;
            transform: translateX(5px);
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.1);
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        td {
            font-size: 15px;
            color: #333;
        }

        .id-badge {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 12px;
        }

        .category-badge {
            background: rgba(118, 75, 162, 0.1);
            color: #764ba2;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 12px;
        }

        .status-badge {
            background: rgba(76, 175, 80, 0.1);
            color: #4caf50;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 12px;
        }

        .edit-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 20px;
            background: rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
            display: inline-block;
        }

        .edit-link:hover {
            background: rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .delete-form {
            display: inline-block;
        }

        .delete-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .delete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
            animation: slimeJiggle 0.5s ease-in-out infinite;
        }

        .delete-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .delete-btn:hover::before {
            left: 100%;
        }

        .nav-section {
            background: rgba(102, 126, 234, 0.05);
            padding: 20px 40px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .nav-link {
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        @keyframes slimeJiggle {
            0%, 100% { 
                border-radius: 20px;
                transform: translateY(-2px) scaleX(1) scaleY(1);
            }
            25% { 
                border-radius: 23px 17px 21px 16px;
                transform: translateY(-2px) scaleX(1.02) scaleY(0.98);
            }
            50% { 
                border-radius: 17px 23px 19px 21px;
                transform: translateY(-2px) scaleX(0.98) scaleY(1.02);
            }
            75% { 
                border-radius: 21px 19px 23px 17px;
                transform: translateY(-2px) scaleX(1.01) scaleY(0.99);
            }
        }

        @media (max-width: 768px) {
            .table-container {
                padding: 20px;
            }
            
            table {
                font-size: 12px;
            }
            
            th, td {
                padding: 8px 6px;
            }
            
            .nav-section {
                flex-direction: column;
                align-items: center;
            }
            
            .nav-link {
                width: 100%;
                max-width: 250px;
                text-align: center;
            }
        }

        .barcode {
            font-family: 'Courier New', monospace;
            background: rgba(0, 0, 0, 0.05);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
        }

        .product-title {
            font-weight: 600;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Ürün Listesi</h1>
            <p>Sistemdeki tüm ürünleri görüntüle ve yönet</p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>📦 Ürün Adı</th>
                        <th>🏷️ Kategori No</th>
                        <th>📂 Kategori</th>
                        <th>🔢 Barkod</th>
                        <th>📋 Durumu</th>
                        <th>✏️ Düzenle</th>
                        <th>🗑️ Sil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $p)
                        <tr>
                            <td><span class="id-badge">#{{ $p->id }}</span></td>
                            <td class="product-title">{{ $p->productTitle }}</td>
                            <td><span class="category-badge">{{ $p->productCategoryId }}</span></td>
                            <td>
                                @foreach($categories as $c)
                                    @if($c->id == $p->productCategoryId)
                                        {{ $c->categoryTitle }}
                                    @endif    
                                @endforeach
                            </td>
                            <td><span class="barcode">{{ $p->productBarcode }}</span></td>
                            <td><span class="status-badge">{{ $p->productStatus }}</span></td>
                            <td>
                                <a href="{{ route('editProduct', $p->id) }}" class="edit-link">✏️ Düzenle</a>
                            </td>
                            <td>
                                <form action="{{ route('deleteProduct', $p->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Silmek istediğinize emin misiniz?')">🗑️ Sil</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
        
        <div class="nav-section">
            <a href="{{ route('main') }}" class="nav-link btn-primary">🏠 Ana Sayfa</a>
            <a href="{{ route('productListDeleted') }}" class="nav-link btn-secondary">🗑️ Silinenler</a>
        </div>
    </div>
</body>
</html>