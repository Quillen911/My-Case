<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
    <style>
        body{
            align-items: center;
            display:flex;
            justify-content: center;
            height: 50vh;,
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container{
            max-width: 600px;
            margin: 40px auto 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.08);
            padding: 32px 28px 24px 28px;
        }
        h1{
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        form{
            justify-content: center;
            background-color:white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            gap: 1px;
            width: 300px;
        }
        input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input:focus {
            outline: none;
            border: 2px solid #4CAF50;
            box-shadow: 0 0 5px #4CAF50;
        }
        button {
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

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        button:hover::before {
            left: 100%;
        }

        button:hover {
            background-color: #45a049;
            transform: rotate(2deg);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
            animation: slimeJiggle 0.5s ease-in-out infinite;
        }

        button:active {
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

        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ADMİN GİRİŞ</h1>

        @if(isset($error))
            <div class="error-message" style="color:red;text-align:center;margin-bottom:10px;">{{ $error }}</div>
        @endif
        @if(isset($success) && $success)
            <p style="color:green;">{{ $success }}</p>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required ><br>
            <input type="password" name="password" placeholder="Şifre" required ><br>
            <button type="submit" >Giriş Yap</button>
        </form>
</div>
</body>
</html>