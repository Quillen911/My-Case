<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silinmiş Ürünler</title>
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
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 30px 40px;
            border-bottom: 1px solid #dee2e6;
            position: relative;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #dc3545, #c82333);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .header-title {
            color: #333;
            font-size: 2.5em;
            font-weight: 300;
            margin: 0;
        }

        .header-subtitle {
            color: #666;
            font-size: 16px;
            margin-top: 5px;
        }

        .stats-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .table-container {
            padding: 0;
            overflow-x: auto;
        }

        .table-wrapper {
            min-width: 1200px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
            border-bottom: 2px solid #dee2e6;
            position: relative;
            white-space: nowrap;
        }

        th::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        th:hover::after {
            width: 100%;
        }

        tbody tr {
            color: #999;
            transition: all 0.3s ease;
            border-bottom: 1px solid #f1f3f4;
            position: relative;
        }

        tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        tbody tr::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(135deg, #dc3545, #c82333);
            transition: width 0.3s ease;
        }

        tbody tr:hover::before {
            width: 4px;
        }

        td {
            padding: 15px 12px;
            font-size: 14px;
            position: relative;
            white-space: nowrap;
        }

        .id-cell {
            font-weight: 600;
            color: #6c757d;
            font-family: 'Courier New', monospace;
            width: 60px;
            min-width: 60px;
        }

        .product-title-cell {
            font-weight: 500;
            color: #495057;
            text-decoration: line-through;
            text-decoration-color: #dc3545;
            text-decoration-thickness: 2px;
            width: auto;
            min-width: 180px;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .category-id-cell {
            font-weight: 600;
            color: #6c757d;
            font-family: 'Courier New', monospace;
            width: 80px;
            min-width: 80px;
        }

        .category-title-cell {
            font-weight: 500;
            color: #495057;
            width: auto;
            min-width: 120px;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .barcode-cell {
            font-weight: 500;
            color: #6c757d;
            font-family: 'Courier New', monospace;
            width: auto;
            min-width: 120px;
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-cell {
            font-weight: 500;
            width: 100px;
            min-width: 100px;
        }

        .status-active {
            color: #28a745;
        }

        .status-inactive {
            color: #dc3545;
        }

        .date-cell {
            color: #dc3545;
            font-weight: 500;
            font-size: 12px;
            width: 130px;
            min-width: 130px;
        }

        .deleted-icon {
            display: inline-block;
            margin-right: 8px;
            color: #dc3545;
            font-size: 16px;
            vertical-align: middle;
        }

        .footer {
            padding: 30px 40px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-top: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .back-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .back-button:hover::before {
            left: 100%;
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            text-decoration: none;
            color: white;
        }

        .footer-info {
            color: #6c757d;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .warning-badge {
            background: linear-gradient(135deg, #ffc107, #ff8f00);
            color: #212529;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .empty-state {
            text-align: center;
            padding: 80px 40px;
            color: #6c757d;
        }

        .empty-icon {
            font-size: 80px;
            margin-bottom: 20px;
            color: #dee2e6;
        }

        .empty-title {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 10px;
            color: #495057;
        }

        .empty-subtitle {
            font-size: 16px;
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header {
                padding: 20px;
            }

            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-title {
                font-size: 2em;
            }

            .product-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }

            .footer {
                padding: 20px;
                flex-direction: column;
                align-items: stretch;
            }

            .back-button {
                text-align: center;
                justify-content: center;
            }

            th, td {
                padding: 10px 8px;
                font-size: 12px;
            }

            .table-wrapper {
                min-width: 1000px;
            }
        }

        /* Scroll animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        tbody tr {
            animation: fadeInUp 0.6s ease-out;
        }

        tbody tr:nth-child(even) {
            animation-delay: 0.1s;
        }

        tbody tr:nth-child(odd) {
            animation-delay: 0.2s;
        }

        /* Loading skeleton for empty states */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            height: 20px;
            margin: 5px 0;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <div class="header-left">
                    <div class="product-icon">📦</div>
                    <div>
                        <h1 class="header-title">Silinmiş Ürünler</h1>
                        <p class="header-subtitle">Sistemden kaldırılan ürün kayıtları</p>
                    </div>
                </div>
                <div class="stats-badge">
                    📊 {{ count($product) }} Silinmiş Ürün
                </div>
            </div>
        </div>

        <div class="table-container">
            @if(count($product) > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>🆔 ID</th>
                                <th>📦 Ürün Adı</th>
                                <th>🏷️ Kat. No</th>
                                <th>📂 Kategori</th>
                                <th>🔢 Barkod</th>
                                <th>⚡ Durum</th>
                                <th>🗓️ Silinme Tarihi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $p)
                                <tr>
                                    <td class="id-cell">#{{ $p->id }}</td>
                                    <td class="product-title-cell">
                                        <span class="deleted-icon">❌</span>
                                        {{ $p->productTitle }}
                                    </td>
                                    <td class="category-id-cell">{{ $p->productCategoryId }}</td>
                                    <td class="category-title-cell">
                                        @foreach($categories as $c)
                                            @if($c->id == $p->productCategoryId)
                                                {{ $c->categoryTitle }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="barcode-cell">{{ $p->productBarcode }}</td>
                                    <td class="status-cell {{ $p->productStatus == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                                        {{ $p->productStatus }}
                                    </td>
                                    <td class="date-cell">
                                        🕒 {{ date('d.m.Y H:i', strtotime($p->deleted_at)) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">🎉</div>
                    <h2 class="empty-title">Silinmiş Ürün Yok</h2>
                    <p class="empty-subtitle">Harika! Şu anda silinmiş ürün kaydı bulunmuyor.</p>
                </div>
            @endif
        </div>

        <div class="footer">
            <div class="footer-info">
                <span class="warning-badge">⚠️ Dikkat</span>
                <span>Silinmiş ürünler kalıcı olarak kaldırılmıştır</span>
            </div>
            <a href="{{ route('list') }}" class="back-button">
                <span>🔙</span>
                <span>Aktif Ürünlere Dön</span>
            </a>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            
            // Add staggered animation to rows
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Add click effect to table rows
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    this.style.transform = 'translateX(10px)';
                    setTimeout(() => {
                        this.style.transform = 'translateX(5px)';
                    }, 200);
                });
            });

            // Add loading effect simulation
            const table = document.querySelector('table');
            if (table) {
                table.style.opacity = '0';
                setTimeout(() => {
                    table.style.transition = 'opacity 0.5s ease';
                    table.style.opacity = '1';
                }, 300);
            }
        });

        // Format dates on load
        document.addEventListener('DOMContentLoaded', function() {
            const dateCells = document.querySelectorAll('.date-cell');
            dateCells.forEach(cell => {
                const text = cell.textContent.trim();
                if (text.includes('🕒')) {
                    cell.innerHTML = cell.innerHTML.replace('🕒', '<span style="color: #dc3545;">🕒</span>');
                }
            });
        });
    </script>
</body>
</html>