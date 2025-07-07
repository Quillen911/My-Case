<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Onayı</title>
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
            max-width: 450px;
            position: relative;
            overflow: hidden;
            text-align: center;
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

        .security-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 10px;
            font-size: 2.2em;
            font-weight: 300;
            position: relative;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
            font-weight: 400;
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

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .floating-label {
            position: relative;
            margin-bottom: 30px;
        }

        .floating-label input {
            padding: 20px 15px 8px 15px;
            width: 100%;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
            outline: none;
        }

        .floating-label input:focus {
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
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

        .error-message {
            color: #e53935;
            font-size: 14px;
            margin-top: 10px;
            font-weight: 500;
            padding: 12px 16px;
            background-color: #ffebee;
            border-radius: 8px;
            border-left: 4px solid #e53935;
            animation: shake 0.5s ease-in-out;
            text-align: left;
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

        .security-warning {
            background: linear-gradient(135deg, #fff3e0, #ffeaa7);
            border: 1px solid #ff8a65;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
            font-size: 14px;
            color: #d84315;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .security-warning-icon {
            font-size: 20px;
            color: #ff5722;
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

            .security-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
        }

        /* Loading animation for submit button */
        .btn-primary.loading {
            background: linear-gradient(135deg, #999, #666);
            cursor: not-allowed;
            animation: loading 1s infinite;
        }

        @keyframes loading {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .password-strength {
            margin-top: 10px;
            font-size: 12px;
            color: #666;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="security-icon">🔒</div>
        <h1>🛡️ Admin Onayı</h1>
        <p class="subtitle">Devam etmek için admin şifrenizi girin</p>
        
        <div class="security-warning">
            <span class="security-warning-icon">⚠️</span>
            <span>Bu işlem yönetici yetkisi gerektirir. Lütfen admin şifrenizi doğru girdiğinizden emin olun.</span>
        </div>
        
        <form action="{{route('postEditVerify', $id)}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            
            <div class="floating-label">
                <div class="input-wrapper">
                    <input type="password" name="password" placeholder=" " required>
                    <label>🔑 Admin Şifre</label>
                </div>
                <div class="password-strength">
                    💡 Güvenlik için şifrenizi kimseyle paylaşmayın
                </div>
                @error('password')
                    <div class="error-message">❌ {{ $message }}</div>
                @enderror
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn-primary" onclick="this.classList.add('loading')">🚀 Onayla</button>
                <a href="{{ route('listUser') }}" class="btn-secondary">🔙 Geri Dön</a>
            </div>
        </form>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const passwordInput = document.querySelector('input[name="password"]');
            const submitButton = document.querySelector('.btn-primary');
            
            // Remove loading class when form submission fails
            form.addEventListener('submit', function() {
                setTimeout(() => {
                    submitButton.classList.remove('loading');
                }, 3000);
            });
            
            // Add focus effects
            passwordInput.addEventListener('focus', function() {
                this.closest('.form-container').style.transform = 'scale(1.02)';
            });
            
            passwordInput.addEventListener('blur', function() {
                this.closest('.form-container').style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>