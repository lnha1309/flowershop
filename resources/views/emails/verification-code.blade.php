<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #8b7355;
            margin: 0;
            font-size: 28px;
        }
        .content {
            margin: 20px 0;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .verification-code {
            background: #f0ebe5;
            border: 2px solid #8b7355;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 25px 0;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #8b7355;
            letter-spacing: 5px;
            font-family: 'Courier New', monospace;
        }
        .expiry {
            color: #999;
            font-size: 14px;
            text-align: center;
            margin: 15px 0;
        }
        .footer {
            text-align: center;
            color: #999;
            font-size: 12px;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            color: #856404;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌸 Florencia Flowershop</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Xin chào <strong>{{ $fullName }}</strong>,
            </div>

            <p>Cảm ơn bạn đã đăng ký tài khoản tại Florencia Flowershop. Để hoàn thành đăng ký, vui lòng nhập mã xác thực dưới đây:</p>

            <div class="verification-code">
                <div class="code">{{ $code }}</div>
            </div>

            <div class="expiry">
                ⏱️ Mã xác thực sẽ hết hạn sau 10 phút
            </div>

            <div class="warning">
                ⚠️ <strong>Lưu ý:</strong> Đây là email tự động, vui lòng không trả lời email này. Nếu bạn không đăng ký tài khoản, hãy bỏ qua email này.
            </div>

            <p style="margin-top: 25px;">
                Nếu bạn gặp vấn đề, vui lòng liên hệ với đội hỗ trợ của chúng tôi.
            </p>

            <p>
                Trân trọng,<br>
                <strong>Đội ngũ Florencia Flowershop</strong>
            </p>
        </div>

        <div class="footer">
            <p>© 2025 Florencia Flowershop. Tất cả quyền được bảo lưu.</p>
            <p>Email: florencia.flowershop.sp@gmail.com</p>
        </div>
    </div>
</body>
</html>
