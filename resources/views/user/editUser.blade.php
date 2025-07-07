<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Düzenle</title>
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
            font-size: 2.2em;
            font-weight: 300;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        .success-message {
            background-color: #e8f5e8;
            color: #2e7d32;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #4caf50;
            font-weight: 500;
            text-align: center;
            animation: slideIn 0.5s ease-out;
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
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .error-message {
            color: #e53935;
            font-size: 14px;
            margin-top: 5px;
            font-weight: 500;
            padding: 8px 12px;
            background-color: #ffebee;
            border-radius: 6px;
            border-left: 3px solid #e53935;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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
            flex: 1;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(108, 117, 125, 0.4);
            text-decoration: none;
            color: white;
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

        .form-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
            pointer-events: none;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .input-wrapper:focus-within::after {
            width: 100%;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 30px 25px;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            h1 {
                font-size: 1.8em;
            }
        }

        /* Floating label effect */
        .floating-label {
            position: relative;
            margin-bottom: 30px;
        }

        .floating-label input {
            padding: 20px 15px 8px 15px;
        }

        .floating-label label {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 16px;
            font-weight: 400;
            color: #999;
            transition: all 0.3s ease;
            pointer-events: none;
            text-transform: none;
            letter-spacing: normal;
        }

        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            top: 5px;
            font-size: 12px;
            color: #667eea;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>✏️ Kullanıcı Düzenle</h1>
        
        @if(isset($success))
            <div class="success-message">✅ {{ $success }}</div>
        @endif
        
        <form action="{{ route('updateUser', $user->id) }}" method="POST">
            @csrf
            
            <div class="floating-label">
                <div class="input-wrapper">
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder=" " required>
                    <label>👤 Kullanıcı Adı</label>
                </div>
                @error('username')
                    <div class="error-message">❌ {{ $message }}</div>
                @enderror
            </div>
            
            <div class="floating-label">
                <div class="input-wrapper">
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder=" " required>
                    <label>📧 Email Adresi</label>
                </div>
                @error('email')
                    <div class="error-message">❌ {{ $message }}</div>
                @enderror
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn-primary">💾 Kaydet</button>
                <a href="{{ route('listUser') }}" class="btn-secondary">🔙 Geri Dön</a>
            </div>
        </form>
    </div>
</body>
</html>