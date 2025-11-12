@extends('layouts.app')
@section('title', 'Đăng ký - Florencia Flowershop')
@section('body_class', 'background-color')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300;400;600&family=Alice:wght@400&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Crimson Pro', serif;
    }

    .register-container {
        max-width: 500px;
        margin: 60px auto;
        padding: 40px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .register-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .register-header h1 {
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 10px;
        font-family: 'Alice', serif;
    }

    .register-header p {
        color: #7f8c8d;
        font-size: 16px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #34495e;
        font-size: 15px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1.5px solid #d0d0d0;
        border-radius: 8px;
        font-size: 15px;
        font-family: 'Crimson Pro', serif;
        transition: all 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #8b7355;
        box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.1);
    }

    .form-group input:disabled {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }
    .form-group input[readonly] {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .verification-section {
        background: #e8f5e9;
        padding: 20px;
        border-radius: 8px;
        margin: 25px 0;
        border-left: 4px solid #4caf50;
        display: none;
    }

    .verification-section.show {
        display: block;
    }

    .verification-section h3 {
        color: #2e7d32;
        margin: 0 0 15px;
        font-size: 16px;
    }

    .verification-code-input {
        display: flex;
        gap: 10px;
    }

    .verification-code-input input {
        flex: 1 1 160px;
        min-width: 140px;
    }

    /* Ensure the verify button doesn't take full width in the row */
    .verification-code-input .verify-code-btn {
        width: auto;
        flex: 0 0 auto;
        white-space: nowrap;
        padding: 12px 16px;
    }

    .send-code-btn,
    .verify-code-btn,
    .register-btn {
        width: 100%;
        padding: 12px;
        background: #8b7355;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Crimson Pro', serif;
    }

    .send-code-btn:hover,
    .verify-code-btn:hover,
    .register-btn:hover {
        background: #6d5644;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 115, 85, 0.3);
    }

    .send-code-btn:disabled,
    .verify-code-btn:disabled,
    .register-btn:disabled {
        background: #bbb;
        cursor: not-allowed;
        transform: none;
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #7f8c8d;
    }

    .login-link a {
        color: #8b7355;
        text-decoration: none;
        font-weight: 600;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-info {
        background: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .loading {
        display: inline-block;
        width: 14px;
        height: 14px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #8b7355;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .verified-badge {
        color: #4caf50;
        font-weight: 600;
        text-align: center;
        margin-top: 15px;
    }

    .error-text {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
    }
</style>
@endpush

@section('content')
<div class="register-container">
    <div class="register-header">
        <h1>Đăng Ký</h1>
        <p>Tạo tài khoản Florencia Flowershop</p>
    </div>

    <div id="alertBox"></div>

    <form id="registerForm" method="POST">
        @csrf

        <!-- Username -->
        <div class="form-group">
            <label for="username">Tên đăng nhập *</label>
            <input type="text" id="username" name="username" required minlength="3" maxlength="50" placeholder="Nhập tên đăng nhập">
        </div>

        <!-- Full Name -->
        <div class="form-group">
            <label for="full_name">Họ và tên *</label>
            <input type="text" id="full_name" name="full_name" required maxlength="100" placeholder="Nhập họ và tên">
        </div>

        <!-- Email and Phone (2 columns) -->
        <div class="form-row">
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required placeholder="your@email.com">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại *</label>
                <input type="tel" id="phone" name="phone" required maxlength="20" placeholder="0123456789">
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Mật khẩu *</label>
            <input type="password" id="password" name="password" required minlength="8" placeholder="Tối thiểu 8 ký tự">
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu *</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Nhập lại mật khẩu">
        </div>

        <!-- Send Verification Code -->
        <button type="button" class="send-code-btn" id="sendCodeBtn" onclick="sendVerificationCode()">
            📧 Gửi mã xác thực
        </button>

        <!-- Verification Section (shown after sending code) -->
        <div id="verificationSection" class="verification-section">
            <h3>✓ Mã xác thực đã được gửi tới email của bạn!</h3>
            <div class="form-group" style="margin: 0;">
                <label for="verification_code">Nhập mã xác thực (6 chữ số) *</label>
                <div class="verification-code-input">
                    <input type="tel" id="verification_code" name="verification_code" maxlength="6" placeholder="000000" inputmode="numeric">
                    <button type="button" class="verify-code-btn" id="verifyCodeBtn" onclick="verifyCode()">
                        Xác thực
                    </button>
                </div>
            </div>
        </div>

        <!-- Register Button -->
        <button type="submit" class="register-btn" id="registerBtn" style="display: none;">
            Hoàn thành đăng ký
        </button>

        <!-- Login Link -->
        <div class="login-link">
            Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
        </div>
    </form>
</div>

<script>
let emailVerified = false;

function showAlert(message, type = 'info') {
    const alertBox = document.getElementById('alertBox');
    alertBox.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
    setTimeout(() => alertBox.innerHTML = '', 5000);
}

function sendVerificationCode() {
    const email = document.getElementById('email').value;
    const fullName = document.getElementById('full_name').value;

    if (!email || !fullName) {
        showAlert('Vui lòng điền đầy đủ email và họ tên', 'error');
        return;
    }

    const btn = document.getElementById('sendCodeBtn');
    btn.disabled = true;
    btn.innerHTML = 'Gui ma xac thuc';

    fetch('{{ route("register.send-verification-code") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            email: email,
            full_name: fullName
        })
    })
    .then(async (response) => {
        const ct = response.headers.get('content-type') || '';
        if (!ct.includes('application/json')) {
            const text = await response.text();
            throw new Error(`Non-JSON response (${response.status}). Body: ${text.slice(0,120)}`);
        }
        const data = await response.json();
        if (!response.ok) {
            const msg = data?.message || `HTTP ${response.status}`;
            throw new Error(msg);
        }
        return data;
    })
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            const section = document.getElementById('verificationSection'); section.classList.add('show'); section.style.display = 'block'; const codeInput = document.getElementById('verification_code'); codeInput.disabled = false; codeInput.readOnly = false; codeInput.style.pointerEvents = 'auto'; codeInput.focus();
            btn.textContent = 'Da gui ma'; startResendCountdown(60);\n        } else {
            showAlert(data.message, 'error');
            btn.disabled = false;
            btn.innerHTML = 'Gui ma xac thuc';
        }
    })
    .catch(error => {
        showAlert('Lỗi: ' + error.message, 'error');
        btn.disabled = false;
        btn.innerHTML = 'Gui ma xac thuc';
    });
}

function verifyCode() {
    const email = document.getElementById('email').value;
    const code = document.getElementById('verification_code').value;

    if (!code || code.length !== 6) {
        showAlert('Vui lòng nhập đầy đủ 6 chữ số', 'error');
        return;
    }

    const btn = document.getElementById('verifyCodeBtn');
    btn.disabled = true;
    btn.innerHTML = 'Gui ma xac thuc';

    fetch('{{ route("register.verify-code") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            email: email,
            code: code
        })
    })
    .then(async (response) => {
        const ct = response.headers.get('content-type') || '';
        if (!ct.includes('application/json')) {
            const text = await response.text();
            throw new Error(`Non-JSON response (${response.status}). Body: ${text.slice(0,120)}`);
        }
        const data = await response.json();
        if (!response.ok) {
            const msg = data?.message || `HTTP ${response.status}`;
            throw new Error(msg);
        }
        return data;
    })
    .then(data => {
        if (data.success) {
            showAlert('✓ ' + data.message, 'success');
            emailVerified = true;
            
            // Update UI
            document.getElementById('email').readOnly = true;
            document.getElementById('full_name').readOnly = true;
            document.getElementById('verification_code').readOnly = true;
            btn.style.display = 'none';
            document.getElementById('sendCodeBtn').style.display = 'none';
            
            // Show verification badge and register button
            const badge = document.createElement('p');
            badge.className = 'verified-badge';
            badge.textContent = '✓ Email đã xác thực';
            document.getElementById('verificationSection').appendChild(badge);
            
            document.getElementById('registerBtn').style.display = 'block';
            document.getElementById('registerBtn').focus();
        } else {
            showAlert(data.message, 'error');
            btn.disabled = false;
            btn.innerHTML = 'Gui ma xac thuc';
        }
    })
    .catch(error => {
        showAlert('Lỗi: ' + error.message, 'error');
        btn.disabled = false;
        btn.innerHTML = 'Gui ma xac thuc';
    });
}

// Form submission
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();

    if (!emailVerified) {
        showAlert('Vui lòng xác thực email trước', 'error');
        return;
    }

    const formData = new FormData(this);
    const btn = document.getElementById('registerBtn');
    btn.disabled = true;
    btn.innerHTML = 'Gui ma xac thuc';

    fetch('{{ route("register") }}', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(async (response) => {
        const ct = response.headers.get('content-type') || '';
        if (!ct.includes('application/json')) {
            const text = await response.text();
            throw new Error(`Non-JSON response (${response.status}). Body: ${text.slice(0,120)}`);
        }
        const data = await response.json();
        if (!response.ok) {
            const msg = data?.message || `HTTP ${response.status}`;
            throw new Error(msg);
        }
        return data;
    })
    .then(data => {
        if (data.success) {
            showAlert('✓ ' + data.message, 'success');
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 2000);
        } else {
            showAlert(data.message, 'error');
            btn.disabled = false;
            btn.innerHTML = 'Gui ma xac thuc';
        }
    })
    .catch(error => {
        showAlert('Lỗi: ' + error.message, 'error');
        btn.disabled = false;
        btn.innerHTML = 'Gui ma xac thuc';
    });
});

// Auto-submit verification code on enter
document.getElementById('verification_code').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        verifyCode();
    }
});

// Format verification code input to only accept numbers
document.getElementById('verification_code').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '').substring(0, 6);
});

// Ensure the send button triggers even if inline onclick is ignored
const __sendBtn = document.getElementById('sendCodeBtn');
if (__sendBtn) {
    __sendBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (this.disabled) return; // prevent double click
        try { sendVerificationCode(); } catch (err) { console.error('sendVerificationCode error:', err); }
    });
    __sendBtn.style.pointerEvents = 'auto';
}

// Also bind verify action without relying on inline onclick
const __verifyBtn = document.getElementById('verifyCodeBtn');
if (__verifyBtn) {
    __verifyBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (this.disabled) return;
        try { verifyCode(); } catch (err) { console.error('verifyCode error:', err); }
    });
}

// Expose functions for inline handlers
window.sendVerificationCode = window.sendVerificationCode || sendVerificationCode;
window.verifyCode = window.verifyCode || verifyCode;
function startResendCountdown(seconds) {
    const btn = document.getElementById('sendCodeBtn');
    if (!btn) return;
    let remaining = parseInt(seconds, 10);
    if (isNaN(remaining) || remaining <= 0) remaining = 60;
    clearInterval(window.__resendTimer);
    btn.disabled = true;
    const tick = () => {
        btn.textContent = 'Gui lai (' + remaining + 's)';
        remaining -= 1;
        if (remaining < 0) {
            clearInterval(window.__resendTimer);
            btn.disabled = false;
            btn.textContent = 'Gui lai ma';
            return;
        }
    };
    tick();
    window.__resendTimer = setInterval(tick, 1000);
}</script>
@endsection

@push('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endpush







