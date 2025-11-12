@extends('layouts.app')

@section('title', 'Tài khoản của tôi - Florencia')

@push('styles')
<style>
    /* CRITICAL: Reset all margins and paddings */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        margin: 0 !important;
        padding: 0 !important;
        min-height: 100vh;
        font-family: 'Alice', serif;
    }

    /* Account Page Layout */
    .account-wrapper {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 30px;
        min-height: 70vh;
    }

    /* Sidebar Navigation */
    .account-sidebar {
        background: white;
        border-radius: 15px;
        padding: 30px 0;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        height: fit-content;
        position: sticky;
        top: 90px;
    }

    .sidebar-header {
        text-align: center;
        padding: 0 20px 25px;
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 20px;
    }

    .sidebar-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #5f7a8a 0%, #4a5f6f 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        box-shadow: 0 4px 12px rgba(95, 122, 138, 0.3);
    }

    .sidebar-avatar i {
        font-size: 40px;
        color: white;
    }

    .sidebar-username {
        font-size: 20px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .sidebar-email {
        font-size: 13px;
        color: #7f8c8d;
    }

    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav li {
        margin: 0;
    }

    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 25px;
        color: #2c3e50;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.3s;
        border-left: 3px solid transparent;
    }

    .sidebar-nav a i {
        width: 20px;
        font-size: 18px;
        color: #5f7a8a;
    }

    .sidebar-nav a:hover {
        background: #f8f9fa;
        border-left-color: #5f7a8a;
        color: #5f7a8a;
    }

    .sidebar-nav a.active {
        background: #f0f5f8;
        border-left-color: #5f7a8a;
        color: #5f7a8a;
        font-weight: 600;
    }

    .sidebar-logout {
        margin-top: 20px;
        padding: 0 25px;
    }

    .sidebar-logout button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Alice', serif;
    }

    .sidebar-logout button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(127, 140, 141, 0.3);
    }

    /* Main Content Area */
    .account-content {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    }

    .content-section {
        display: none;
    }

    .content-section.active {
        display: block;
    }

    .section-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
    }

    .section-header h2 {
        font-size: 28px;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .section-header p {
        color: #7f8c8d;
        font-size: 15px;
    }

    /* Personal Information Section */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
        color: #34495e;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1.5px solid #d0d0d0;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
        font-family: 'Alice', serif;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #5f7a8a;
        box-shadow: 0 0 0 3px rgba(95, 122, 138, 0.1);
    }

    .form-group input:disabled {
        background-color: #f5f5f5;
        cursor: not-allowed;
        color: #999;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .btn-group {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Alice', serif;
    }

    .btn-primary {
        background: linear-gradient(135deg, #5f7a8a 0%, #4a5f6f 100%);
        color: white;
        box-shadow: 0 3px 10px rgba(95, 122, 138, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(95, 122, 138, 0.4);
    }

    .btn-secondary {
        background: #e8e8e8;
        color: #2c3e50;
    }

    .btn-secondary:hover {
        background: #d5d5d5;
    }

    /* Wishlist Section */
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .wishlist-item {
        background: #f8f9fa;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s;
        border: 1px solid #e8e8e8;
    }

    .wishlist-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .wishlist-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .wishlist-info {
        padding: 15px;
    }

    .wishlist-info h4 {
        font-size: 18px;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .wishlist-price {
        font-size: 20px;
        color: #5f7a8a;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .wishlist-actions {
        display: flex;
        gap: 10px;
    }

    .wishlist-actions button {
        flex: 1;
        padding: 8px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-add-cart {
        background: #5f7a8a;
        color: white;
    }

    .btn-add-cart:hover {
        background: #4a5f6f;
    }

    .btn-remove {
        background: #e74c3c;
        color: white;
    }

    .btn-remove:hover {
        background: #c0392b;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }

    .empty-state i {
        font-size: 64px;
        color: #d0d0d0;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 16px;
        margin-bottom: 25px;
    }

    .empty-state a {
        display: inline-block;
        padding: 12px 30px;
        background: #5f7a8a;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .empty-state a:hover {
        background: #4a5f6f;
        transform: translateY(-2px);
    }

    /* Order Sections */
    .order-list {
        margin-top: 20px;
    }

    .order-card {
        background: #f8f9fa;
        border: 1px solid #e8e8e8;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s;
    }

    .order-card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .order-id {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
    }

    .order-date {
        font-size: 14px;
        color: #7f8c8d;
    }

    .order-status {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-processing {
        background: #fff3cd;
        color: #856404;
    }

    .status-shipped {
        background: #cce5ff;
        color: #004085;
    }

    .status-delivered {
        background: #d4edda;
        color: #155724;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .order-items {
        margin: 15px 0;
    }

    .order-item {
        display: flex;
        gap: 15px;
        padding: 10px 0;
    }

    .order-item img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
    }

    .order-item-info {
        flex: 1;
    }

    .order-item-info h5 {
        font-size: 16px;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .order-item-details {
        font-size: 14px;
        color: #7f8c8d;
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e0e0e0;
    }

    .order-total {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
    }

    .order-actions {
        display: flex;
        gap: 10px;
    }

    .order-actions button {
        padding: 8px 20px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-track {
        background: #5f7a8a;
        color: white;
    }

    .btn-track:hover {
        background: #4a5f6f;
    }

    .btn-reorder {
        background: #e8e8e8;
        color: #2c3e50;
    }

    .btn-reorder:hover {
        background: #d5d5d5;
    }

    /* Tracking Timeline */
    .tracking-timeline {
        margin-top: 25px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .timeline-item {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        position: relative;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 40px;
        width: 2px;
        height: calc(100% + 10px);
        background: #d0d0d0;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-icon {
        width: 40px;
        height: 40px;
        background: white;
        border: 3px solid #d0d0d0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: #7f8c8d;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .timeline-item.active .timeline-icon {
        background: #5f7a8a;
        border-color: #5f7a8a;
        color: white;
    }

    .timeline-content h4 {
        font-size: 16px;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .timeline-content p {
        font-size: 14px;
        color: #7f8c8d;
        margin-bottom: 3px;
    }

    .success-message {
        display: none;
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
        border: 1px solid #c3e6cb;
    }

    .success-message.show {
        display: block;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .account-wrapper {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .account-sidebar {
            position: relative;
            top: 0;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .wishlist-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (max-width: 576px) {
        .account-content {
            padding: 25px 20px;
        }

        .section-header h2 {
            font-size: 24px;
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .order-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .order-actions {
            width: 100%;
        }

        .order-actions button {
            flex: 1;
        }
    }
</style>
@endpush

@section('content')
<!-- Account Page Layout -->
<div class="account-wrapper">
    <!-- Sidebar Navigation -->
    <aside class="account-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="sidebar-username" id="sidebarUsername">{{ Auth::user()->full_name ?? Auth::user()->username ?? 'John Doe' }}</div>
            <div class="sidebar-email" id="sidebarEmail">{{ Auth::user()->email ?? 'johndoe@example.com' }}</div>
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="#" class="nav-link active" data-section="personal-info">
                    <i class="fa-solid fa-user"></i>
                    <span>Thông tin cá nhân</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link" data-section="wishlist">
                    <i class="fa-solid fa-heart"></i>
                    <span>Danh sách yêu thích</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link" data-section="current-orders">
                    <i class="fa-solid fa-truck-fast"></i>
                    <span>Đơn hàng hiện tại</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link" data-section="order-history">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span>Lịch sử đơn hàng</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-logout">
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="account-content">
        <!-- Personal Information Section -->
        <section id="personal-info" class="content-section active">
            <div class="section-header">
                <h2>Thông tin cá nhân</h2>
                <p>Quản lý thông tin tài khoản và cài đặt của bạn</p>
            </div>

            <div class="success-message" id="successMessage">
                <i class="fa-solid fa-check-circle"></i> Thông tin của bạn đã được cập nhật thành công!
            </div>

            <form id="accountForm" action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div id="viewMode">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tên đăng nhập</label>
                            <input type="text" id="viewUsername" value="{{ Auth::user()->username ?? '' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text" id="viewFullname" value="{{ Auth::user()->full_name ?? '' }}" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Giới tính</label>
                            <input type="text" id="viewGender" value="{{ Auth::user()->gender ?? '' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="viewEmail" value="{{ Auth::user()->email ?? '' }}" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="tel" id="viewPhone" value="{{ Auth::user()->phone ?? '' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" value="••••••••" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" id="viewAddress" value="{{ optional($shippingAddress)->address_detail ?? '' }}" disabled>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Quận/Huyện</label>
                            <input type="text" id="viewDistrict" value="{{ optional($shippingAddress)->district ?? '' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tỉnh/Thành phố</label>
                            <input type="text" id="viewProvince" value="{{ optional($shippingAddress)->province ?? '' }}" disabled>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" onclick="enableEdit()">
                            <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa thông tin
                        </button>
                    </div>
                </div>

                <div id="editMode" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tên đăng nhập <span style="color: #999;">(Không thể thay đổi)</span></label>
                            <input type="text" id="editUsername" name="username" value="{{ Auth::user()->username ?? '' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Họ và tên *</label>
                            <input type="text" id="editFullname" name="full_name" value="{{ Auth::user()->full_name ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Giới tính *</label>
                            <select id="editGender" name="gender" required>
                                <option value="">Chọn giới tính</option>
                                <option value="Nam" {{ (Auth::user()->gender ?? '') == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ (Auth::user()->gender ?? '') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Khác" {{ (Auth::user()->gender ?? '') == 'Khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" id="editEmail" name="email" value="{{ Auth::user()->email ?? '' }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Số điện thoại *</label>
                            <input type="tel" id="editPhone" name="phone" value="{{ Auth::user()->phone ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới (để trống nếu không đổi)</label>
                            <input type="password" id="editPassword" name="password" placeholder="Nhập mật khẩu mới">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" id="editAddress" name="address_detail" value="{{ optional($shippingAddress)->address_detail ?? '' }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Quận/Huyện</label>
                            <input type="text" id="editDistrict" name="district" value="{{ optional($shippingAddress)->district ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label>Tỉnh/Thành phố</label>
                            <input type="text" id="editProvince" name="province" value="{{ optional($shippingAddress)->province ?? '' }}">
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="cancelEdit()">
                            <i class="fa-solid fa-xmark"></i> Hủy
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Wishlist Section -->
        <section id="wishlist" class="content-section">
            <div class="section-header">
                <h2>Danh sách yêu thích</h2>
                <p>Những sản phẩm yêu thích của bạn</p>
            </div>

            <div class="wishlist-grid" id="wishlistGrid">
                {{-- Loop through wishlist items here --}}
                @forelse($wishlistItems ?? [] as $item)
                <div class="wishlist-item" data-product-id="{{ $item->product_id }}">
                    <img src="{{ asset($item->image_url ?? '/images/default-product.png') }}" alt="{{ $item->name }}">
                    <div class="wishlist-info">
                        <h4>{{ $item->name }}</h4>
                        <div class="wishlist-price">₫{{ number_format($item->price, 0, ',', '.') }}</div>
                        <div class="wishlist-actions">
                            <button class="btn-add-cart" onclick="addToCartFromWishlist({{ $item->product_id }})"><i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
                            <button class="btn-remove" onclick="removeFromWishlist({{ $item->product_id }})"><i class="fa-solid fa-trash"></i> Xóa</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="fa-solid fa-heart"></i>
                    <h3>Danh sách yêu thích trống</h3>
                    <p>Bạn chưa có sản phẩm yêu thích nào</p>
                    <a href="{{ route('products.index') }}">Khám phá sản phẩm</a>
                </div>
                @endforelse
            </div>
        </section>

        <!-- Current Orders Section -->
        <section id="current-orders" class="content-section">
            <div class="section-header">
                <h2>Đơn hàng hiện tại</h2>
                <p>Theo dõi các đơn hàng đang giao</p>
            </div>

            <div class="order-list">
                {{-- Loop through current orders here --}}
                @forelse($currentOrders ?? [] as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Đơn hàng #{{ $order->order_number }}</div>
                            <div class="order-date">Đặt ngày {{ $order->created_at->format('d/m/Y') }}</div>
                        </div>
                        <span class="order-status status-{{ strtolower($order->status) }}">{{ $order->status_text }}</span>
                    </div>

                    <div class="order-items">
                        @foreach($order->items as $item)
                        <div class="order-item">
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}">
                            <div class="order-item-info">
                                <h5>{{ $item->product->name }}</h5>
                                <div class="order-item-details">Số lượng: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($order->tracking)
                    <div class="tracking-timeline">
                        @foreach($order->tracking as $track)
                        <div class="timeline-item {{ $track->is_active ? 'active' : '' }}">
                            <div class="timeline-icon">
                                <i class="{{ $track->icon }}"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>{{ $track->title }}</h4>
                                <p>{{ $track->date }}</p>
                                <p>{{ $track->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="order-footer">
                        <div class="order-total">Tổng: <strong>${{ number_format($order->total, 2) }}</strong></div>
                        <div class="order-actions">
                            <button class="btn-track">Xem chi tiết</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="fa-solid fa-box-open"></i>
                    <h3>Không có đơn hàng nào</h3>
                    <p>Bạn chưa có đơn hàng nào đang xử lý</p>
                    <a href="{{ route('products.index') }}">Mua sắm ngay</a>
                </div>
                @endforelse
            </div>
        </section>

        <!-- Order History Section -->
        <section id="order-history" class="content-section">
            <div class="section-header">
                <h2>Lịch sử đơn hàng</h2>
                <p>Xem lại các đơn hàng đã mua</p>
            </div>

            <div class="order-list">
                {{-- Loop through order history here --}}
                @forelse($orderHistory ?? [] as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Đơn hàng #{{ $order->order_number }}</div>
                            <div class="order-date">Đặt ngày {{ $order->created_at->format('d/m/Y') }}</div>
                        </div>
                        <span class="order-status status-delivered">Đã giao</span>
                    </div>

                    <div class="order-items">
                        @foreach($order->items as $item)
                        <div class="order-item">
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}">
                            <div class="order-item-info">
                                <h5>{{ $item->product->name }}</h5>
                                <div class="order-item-details">Số lượng: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="order-footer">
                        <div class="order-total">Tổng: <strong>${{ number_format($order->total, 2) }}</strong></div>
                        <div class="order-actions">
                            <button class="btn-reorder">Đặt lại</button>
                            <button class="btn-track">Xem chi tiết</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <h3>Chưa có lịch sử</h3>
                    <p>Bạn chưa có đơn hàng nào trước đây</p>
                    <a href="{{ route('products.index') }}">Bắt đầu mua sắm</a>
                </div>
                @endforelse
            </div>
        </section>
    </main>
</div>
@endsection

@push('scripts')
<script>
    // Load user data
    window.addEventListener('DOMContentLoaded', function() {
        setupNavigation();
    });

    function setupNavigation() {
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('.content-section');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                
                sections.forEach(s => s.classList.remove('active'));
                
                const sectionId = this.dataset.section;
                document.getElementById(sectionId).classList.add('active');
            });
        });
    }

    function enableEdit() {
        document.getElementById('viewMode').style.display = 'none';
        document.getElementById('editMode').style.display = 'block';
    }

    function cancelEdit() {
        document.getElementById('editMode').style.display = 'none';
        document.getElementById('viewMode').style.display = 'block';
        document.getElementById('editPassword').value = '';
    }

    // Handle form submission with AJAX (optional)
    document.getElementById('accountForm').addEventListener('submit', function(e) {
        // If you want to use AJAX instead of regular form submission
        // e.preventDefault();
        // Add your AJAX code here
    });

    // Show success message if exists
    @if(session('success'))
    const successMessage = document.getElementById('successMessage');
    successMessage.classList.add('show');
    setTimeout(() => {
        successMessage.classList.remove('show');
    }, 3000);
    window.scrollTo({ top: 0, behavior: 'smooth' });
    @endif

    // Wishlist Actions
    async function addToCartFromWishlist(productId) {
        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            });

            const data = await response.json();
            if (data.success) {
                // Update cart in header if loadCart is available
                if (typeof loadCart === 'function') {
                    await loadCart();
                }
            } else {
                alert(data.message || 'Lỗi thêm vào giỏ hàng');
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            alert('Lỗi khi thêm vào giỏ hàng');
        }
    }

    async function removeFromWishlist(productId) {
        if (confirm('Bạn chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?')) {
            try {
                const response = await fetch(`/wishlist/remove/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                const data = await response.json();
                if (data.success) {
                    // Remove item from DOM without reloading
                    const wishlistItem = document.querySelector(`.wishlist-item[data-product-id="${productId}"]`);
                    if (wishlistItem) {
                        wishlistItem.remove();
                    }
                    
                    // Check if wishlist is now empty
                    const remainingItems = document.querySelectorAll('.wishlist-item');
                    if (remainingItems.length === 0) {
                        const wishlistGrid = document.getElementById('wishlistGrid');
                        wishlistGrid.innerHTML = `
                            <div class="empty-state">
                                <i class="fa-solid fa-heart"></i>
                                <h3>Danh sách yêu thích trống</h3>
                                <p>Bạn chưa có sản phẩm yêu thích nào</p>
                                <a href="/products">Khám phá sản phẩm</a>
                            </div>
                        `;
                    }
                } else {
                    alert(data.message || 'Lỗi xóa khỏi danh sách yêu thích');
                }
            } catch (error) {
                console.error('Error removing from wishlist:', error);
                alert('Lỗi khi xóa khỏi danh sách yêu thích');
            }
        }
    }
</script>
@endpush
