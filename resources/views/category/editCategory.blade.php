<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Düzenle</title>
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
            max-width: 600px;
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

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .category-icon {
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
            font-size: 2.2em;
            font-weight: 300;
            margin-bottom: 10px;
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

        .form-subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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

        .floating-label {
            position: relative;
            margin-bottom: 30px;
        }

        .floating-label input,
        .floating-label textarea,
        .floating-label select {
            width: 100%;
            padding: 20px 15px 8px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
            outline: none;
            font-family: inherit;
        }

        .floating-label textarea {
            resize: vertical;
            min-height: 100px;
        }

        .floating-label input:focus,
        .floating-label textarea:focus,
        .floating-label select:focus {
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label,
        .floating-label textarea:focus + label,
        .floating-label textarea:not(:placeholder-shown) + label,
        .floating-label select:focus + label,
        .floating-label select:not([value=""]) + label {
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .status-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }

        .status-indicator {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .status-active {
            background-color: #4caf50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
        }

        .status-inactive {
            background-color: #f44336;
            box-shadow: 0 0 10px rgba(244, 67, 54, 0.3);
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 40px;
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
            gap: 8px;
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

        .form-tip {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border: 1px solid #2196f3;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
            font-size: 14px;
            color: #1565c0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .character-count {
            font-size: 12px;
            color: #666;
            text-align: right;
            margin-top: 5px;
        }

        .character-count.warning {
            color: #ff9800;
        }

        .character-count.error {
            color: #f44336;
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

            .category-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <div class="category-icon">📁</div>
            <h1>📝 Kategori Düzenle</h1>
            <p class="form-subtitle">Kategori bilgilerini güncelleyin</p>
        </div>

        <div class="form-tip">
            <span>💡</span>
            <span>Kategori durumu değişikliği, bu kategorideki tüm içerikleri etkileyebilir.</span>
        </div>
        
        @if(isset($success))
            <div class="success-message">
                <span>✅</span>
                <span>{{ $success }}</span>
            </div>
        @endif
        
        <form action="{{ route('editCategory', $category->id) }}" method="POST">
            @csrf
            
            <div class="floating-label">
                <div class="input-wrapper">
                    <input type="text" name="categoryTitle" value="{{ old('categoryTitle', $category->categoryTitle) }}" placeholder=" " required maxlength="100">
                    <label>
                        <span>📂</span>
                        <span>Kategori Adı</span>
                    </label>
                </div>
                <div class="character-count" id="titleCount">0/100 karakter</div>
                @error('categoryTitle')
                    <div class="error-message">
                        <span>❌</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            
            <div class="floating-label">
                <div class="input-wrapper">
                    <textarea name="categoryDesc" placeholder=" " maxlength="500">{{ old('categoryDesc', $category->categoryDesc) }}</textarea>
                    <label>
                        <span>📝</span>
                        <span>Kategori Açıklaması</span>
                    </label>
                </div>
                <div class="character-count" id="descCount">0/500 karakter</div>
                @error('categoryDesc')
                    <div class="error-message">
                        <span>❌</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            
            <div class="floating-label">
                <div class="input-wrapper">
                <input type="text" name="categoryStatus" value="{{ old('categoryStatus', $category->categoryStatus) }}" placeholder=" " required maxlength="100">
                    <label>
                        <span>🔄</span>
                        <span>Kategori Durumu</span>
                    </label>
                    <div class="status-indicator" id="statusIndicator"></div>
                </div>
                @error('categoryStatus')
                    <div class="error-message">
                        <span>❌</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn-primary">
                    💾 Güncelle
                </button>
                <a href="{{ route('category.list') }}" class="btn-secondary">
                    <span>🔙</span>
                    <span>Geri Dön</span>
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.querySelector('input[name="categoryTitle"]');
            const descInput = document.querySelector('textarea[name="categoryDesc"]');
            const statusSelect = document.querySelector('select[name="categoryStatus"]');
            const titleCount = document.getElementById('titleCount');
            const descCount = document.getElementById('descCount');
            const statusIndicator = document.getElementById('statusIndicator');

            // Character count functions
            function updateCharacterCount(input, counter, maxLength) {
                const currentLength = input.value.length;
                counter.textContent = `${currentLength}/${maxLength} karakter`;
                
                if (currentLength > maxLength * 0.8) {
                    counter.classList.add('warning');
                } else {
                    counter.classList.remove('warning');
                }
                
                if (currentLength > maxLength * 0.95) {
                    counter.classList.add('error');
                } else {
                    counter.classList.remove('error');
                }
            }

            // Initialize character counts
            updateCharacterCount(titleInput, titleCount, 100);
            updateCharacterCount(descInput, descCount, 500);

            // Update character counts on input
            titleInput.addEventListener('input', () => updateCharacterCount(titleInput, titleCount, 100));
            descInput.addEventListener('input', () => updateCharacterCount(descInput, descCount, 500));

            // Status indicator
            function updateStatusIndicator() {
                const value = statusSelect.value;
                statusIndicator.className = 'status-indicator';
                
                if (value === 'aktif') {
                    statusIndicator.classList.add('status-active');
                } else if (value === 'pasif') {
                    statusIndicator.classList.add('status-inactive');
                }
            }

            // Initialize status indicator
            updateStatusIndicator();
            statusSelect.addEventListener('change', updateStatusIndicator);

            // Form submission loading state
            const form = document.querySelector('form');
            const submitButton = document.querySelector('.btn-primary');
            
            form.addEventListener('submit', function() {
                submitButton.style.background = 'linear-gradient(135deg, #999, #666)';
                submitButton.style.cursor = 'not-allowed';
                submitButton.innerHTML = '⏳ Güncelleniyor...';
                
                // Re-enable after 5 seconds in case of error
                setTimeout(() => {
                    submitButton.style.background = 'linear-gradient(135deg, #667eea, #764ba2)';
                    submitButton.style.cursor = 'pointer';
                    submitButton.innerHTML = '💾 Güncelle';
                }, 5000);
            });

            // Auto-resize textarea
            descInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });

            // Initialize textarea height
            descInput.style.height = descInput.scrollHeight + 'px';
        });
    </script>
</body>
</html>