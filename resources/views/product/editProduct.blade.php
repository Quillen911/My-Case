<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Düzenle</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
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

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 300;
            position: relative;
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

        .message {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
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

        .field-error {
            background-color: #ffebee;
            color: #c62828;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 4px;
            margin-top: 5px;
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

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        input[type="text"]::placeholder {
            color: #999;
            font-size: 14px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 15px 25px;
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
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            animation: slimeJiggle 0.5s ease-in-out infinite;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(108, 117, 125, 0.4);
        }

        button:active {
            transform: translateY(0) scale(0.95);
        }

        @keyframes slimeJiggle {
            0%, 100% { 
                border-radius: 12px;
                transform: translateY(-3px) scaleX(1) scaleY(1);
            }
            25% { 
                border-radius: 15px 9px 13px 8px;
                transform: translateY(-3px) scaleX(1.02) scaleY(0.98);
            }
            50% { 
                border-radius: 9px 15px 11px 13px;
                transform: translateY(-3px) scaleX(0.98) scaleY(1.02);
            }
            75% { 
                border-radius: 13px 11px 15px 9px;
                transform: translateY(-3px) scaleX(1.01) scaleY(0.99);
            }
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 30px 25px;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            h1 {
                font-size: 1.6em;
            }
        }

        .form-group.has-error input {
            border-color: #e53935;
            background-color: #ffebee;
        }

        .form-group.has-error input:focus {
            border-color: #c62828;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
        }

        .product-info {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid #667eea;
        }

        .product-info h3 {
            color: #667eea;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .product-info p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>✏️ Ürün Düzenle</h1>
        
        <div class="product-info">
            <h3>📦 Düzenlenen Ürün</h3>
            <p>ID: #{{ $product->id }}</p>
        </div>
        
        @if(isset($success))
            <div class="message success">✅ {{ $success }}</div>
        @endif
        
        <form action="{{ route('updateProduct', $product->id) }}" method="POST">
            @csrf
            
            <div class="form-group @error('productTitle') has-error @enderror">
                <label for="productTitle">📦 Ürün Adı:</label>
                <input type="text" id="productTitle" name="productTitle" value="{{ old('productTitle', $product->productTitle) }}">
                @error('productTitle')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group @error('productCategoryId') has-error @enderror">
                <label for="productCategoryId">🏷️ Ürün Kategori Numarası:</label>
                <input type="text" id="productCategoryId" name="productCategoryId" value="{{ old('productCategoryId', $product->productCategoryId) }}">
                @error('productCategoryId')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group @error('productBarcode') has-error @enderror">
                <label for="productBarcode">🔢 Ürün Barkodu:</label>
                <input type="text" id="productBarcode" name="productBarcode" value="{{ old('productBarcode', $product->productBarcode) }}">
                @error('productBarcode')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group @error('productStatus') has-error @enderror">
                <label for="productStatus">📋 Ürün Durumu:</label>
                <input type="text" id="productStatus" name="productStatus" value="{{ old('productStatus', $product->productStatus) }}">
                @error('productStatus')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn-primary">💾 Kaydet</button>
                <a href="{{ route('list') }}" class="btn-secondary">🔙 Geri Dön</a>
            </div>
        </form>
    </div>
</body>
</html>