(() => {
  let emailVerified = false;

  function qs(sel) { return document.querySelector(sel); }
  function alertBox() { return qs('#alertBox'); }

  function showAlert(message, type = 'info') {
    const box = alertBox();
    if (!box) return;
    box.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
    setTimeout(() => { if (box.innerHTML.includes(message)) box.innerHTML = ''; }, 5000);
  }

  function startResendCountdown(seconds) {
    const btn = qs('#sendCodeBtn');
    if (!btn) return;
    let remaining = parseInt(seconds, 10);
    if (isNaN(remaining) || remaining <= 0) remaining = 60;
    clearInterval(window.__resendTimer);
    btn.disabled = true;
    btn.setAttribute('aria-disabled', 'true');
    btn.style.pointerEvents = 'none';
    const tick = () => {
      btn.textContent = `Gửi lại (${remaining}s)`;
      remaining -= 1;
      if (remaining < 0) {
        clearInterval(window.__resendTimer);
        btn.disabled = false;
        btn.removeAttribute('aria-disabled');
        btn.style.pointerEvents = 'auto';
        btn.textContent = 'Gửi lại mã';
      }
    };
    tick();
    window.__resendTimer = setInterval(tick, 1000);
  }

  async function fetchJson(url, options = {}) {
    const res = await fetch(url, options);
    const ct = res.headers.get('content-type') || '';
    if (!ct.includes('application/json')) {
      const text = await res.text();
      throw new Error(`Non-JSON (${res.status}): ${text.slice(0,120)}`);
    }
    const data = await res.json();
    if (!res.ok) {
      const msg = data?.message || `HTTP ${res.status}`;
      const err = new Error(msg);
      err.status = res.status;
      err.data = data;
      throw err;
    }
    return data;
  }

  async function sendVerificationCode() {
    const email = qs('#email')?.value?.trim();
    const fullName = qs('#full_name')?.value?.trim();
    const btn = qs('#sendCodeBtn');
    if (!email || !fullName) {
      showAlert('Vui lòng điền đủ email và họ tên', 'error');
      return;
    }
    btn && (btn.disabled = true, btn.innerHTML = '<span class="loading"></span> Đang gửi...');
    try {
      const token = qs('meta[name="csrf-token"]')?.content;
      const data = await fetchJson('/register/send-verification-code', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': token || ''
        },
        body: JSON.stringify({ email, full_name: fullName })
      });
      showAlert(data.message || 'Đã gửi mã', 'success');
      const section = qs('#verificationSection');
      section && (section.classList.add('show'), section.style.display = 'block');
      const codeInput = qs('#verification_code');
      if (codeInput) { codeInput.disabled = false; codeInput.readOnly = false; codeInput.style.pointerEvents = 'auto'; codeInput.focus(); }
      btn && (btn.textContent = 'Đã gửi mã');
      startResendCountdown(data.cooldown || 60);
    } catch (e) {
      if (e.status === 429 && e.data?.retry_after) startResendCountdown(e.data.retry_after);
      showAlert('Lỗi: ' + e.message, 'error');
      btn && (btn.disabled = false, btn.innerHTML = 'Gửi mã xác thực');
    }
  }

  async function verifyCode() {
    const email = qs('#email')?.value?.trim();
    const code = qs('#verification_code')?.value?.trim();
    const btn = qs('#verifyCodeBtn');
    if (!code || code.length !== 6) {
      showAlert('Vui lòng nhập đủ 6 chữ số', 'error');
      return;
    }
    btn && (btn.disabled = true, btn.innerHTML = '<span class="loading"></span> Đang xác thực...');
    try {
      const token = qs('meta[name="csrf-token"]')?.content;
      const data = await fetchJson('/register/verify-code', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': token || ''
        },
        body: JSON.stringify({ email, code })
      });
      showAlert('✔ ' + (data.message || 'Xác thực thành công'), 'success');
      emailVerified = true;
      ['#email', '#full_name', '#verification_code'].forEach(sel => { const el = qs(sel); if (el) el.readOnly = true; });
      btn && (btn.style.display = 'none');
      const sendBtn = qs('#sendCodeBtn'); if (sendBtn) sendBtn.style.display = 'none';
      const badge = document.createElement('p'); badge.className = 'verified-badge'; badge.textContent = '✔ Email đã xác thực'; qs('#verificationSection')?.appendChild(badge);
      const registerBtn = qs('#registerBtn'); if (registerBtn) { registerBtn.style.display = 'block'; registerBtn.focus(); }
    } catch (e) {
      showAlert(e.message, 'error');
      btn && (btn.disabled = false, btn.innerHTML = 'Xác thực');
    }
  }

  function setupForm() {
    const form = qs('#registerForm');
    if (!form) return;
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (!emailVerified) { showAlert('Vui lòng xác thực email trước', 'error'); return; }
      const btn = qs('#registerBtn');
      btn && (btn.disabled = true, btn.innerHTML = '<span class="loading"></span> Đang đăng ký...');
      try {
        const token = qs('meta[name="csrf-token"]')?.content;
        const res = await fetch('/register', {
          method: 'POST',
          headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': token || '' },
          body: new FormData(form)
        });
        const ct = res.headers.get('content-type') || '';
        if (!ct.includes('application/json')) { throw new Error('Unexpected response'); }
        const data = await res.json();
        if (!res.ok || !data.success) throw new Error(data?.message || `HTTP ${res.status}`);
        showAlert('✔ ' + (data.message || 'Đăng ký thành công'), 'success');
        setTimeout(() => { if (data.redirect) window.location.href = data.redirect; }, 1200);
      } catch (e) {
        showAlert('Lỗi: ' + e.message, 'error');
        btn && (btn.disabled = false, btn.innerHTML = 'Hoàn thành đăng ký');
      }
    });
  }

  function wireEvents() {
    const sendBtn = qs('#sendCodeBtn');
    const verifyBtn = qs('#verifyCodeBtn');
    sendBtn && sendBtn.addEventListener('click', (e) => { e.preventDefault(); if (sendBtn.disabled) return; sendVerificationCode(); });
    verifyBtn && verifyBtn.addEventListener('click', (e) => { e.preventDefault(); if (!verifyBtn.disabled) verifyCode(); });
    const code = qs('#verification_code');
    code && code.addEventListener('input', (e) => { e.target.value = e.target.value.replace(/[^0-9]/g, '').substring(0,6); });
    code && code.addEventListener('keypress', (e) => { if (e.key === 'Enter') { e.preventDefault(); verifyCode(); } });
  }

  window.addEventListener('DOMContentLoaded', () => {
    wireEvents();
    setupForm();
  });

  // Expose for inline handlers if any remain
  window.sendVerificationCode = sendVerificationCode;
  window.verifyCode = verifyCode;
})();
