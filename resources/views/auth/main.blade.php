<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            background-color: white;
            margin-right: 280px;
        }

        h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: 300;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 0;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.3em;
            font-weight: 400;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 15px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            position: relative;
            overflow: hidden;
        }

        .sidebar a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.1);
            transition: left 0.3s ease;
        }

        .sidebar a:hover::before {
            left: 0;
        }

        .sidebar a:hover {
            background-color: rgba(255,255,255,0.2);
            transform: translateX(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .logout-section {
            position: absolute;
            bottom: 30px;
            left: 15px;
            right: 15px;
        }

        .logout-form button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .logout-form button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .logout-form button:hover::before {
            left: 100%;
        }

        .logout-form button:hover {
            background-color: #45a049;
            transform: rotate(2deg);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
            animation: slimeJiggle 0.5s ease-in-out infinite;
        }

        .logout-form button:active {
            transform: rotate(2deg) scale(0.95);
        }

        @keyframes slimeJiggle {
            0%, 100% { 
                border-radius: 8px;
                transform: rotate(2deg) scaleX(1) scaleY(1);
            }
            25% { 
                border-radius: 12px 6px 10px 4px;
                transform: rotate(2deg) scaleX(1.02) scaleY(0.98);
            }
            50% { 
                border-radius: 6px 12px 8px 10px;
                transform: rotate(2deg) scaleX(0.98) scaleY(1.02);
            }
            75% { 
                border-radius: 10px 8px 12px 6px;
                transform: rotate(2deg) scaleX(1.01) scaleY(0.99);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-right: 0;
                margin-top: 60px;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Hoş Geldiniz {{auth()->user()->username }}</h1>
        <p>Admin paneline hoş geldiniz. Sağdaki menüden istediğiniz işlemi seçebilirsiniz.</p>
    </div>

    <div class="sidebar">
        <h2>Admin Menüsü</h2>
        
        <a href="/user/add">👤 Kullanıcı Ekle</a>
        <a href="/user/list">👥 Tüm Kullanıcılar</a>
        <a href="/category/add">📁 Kategori Ekle</a>
        <a href="/category/list">📂 Kategori Listesi</a>
        <a href="/product/add">📦 Ürün Ekle</a>
        <a href="/product/list">📋 Ürün Listesi</a>
        
        <div class="logout-section">
            <form action="{{ route('getSettings') }}"  class="logout-form">
                @csrf
                <button type="submit">Admin Ayarları</button>
            </form>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit">🚪 Çıkış Yap</button>
            </form>
        </div>
    </div>
</body>
</html>